import java.util.*;
import java.io.*;
import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import weka.classifiers.Classifier;
import weka.classifiers.bayes.NaiveBayes; 
import weka.classifiers.Evaluation;
import weka.classifiers.evaluation.NominalPrediction;
import weka.classifiers.rules.JRip;
import weka.core.FastVector;
import weka.experiment.InstanceQuery;
import weka.filters.Filter;
import weka.filters.unsupervised.attribute.NumericToNominal;
import weka.filters.unsupervised.attribute.StringToNominal;
import weka.core.Instances;

public class Predictor {
	public static BufferedReader readDataFile(String filename) {
		BufferedReader inputReader = null;
 
		try {
			inputReader = new BufferedReader(new FileReader(filename));
		} catch (FileNotFoundException ex) {
			System.err.println("File not found: " + filename);
		}
 
		return inputReader;
	}
 
	public static Evaluation classify(Classifier model,Instances trainingSet, Instances testingSet) 
        throws Exception {
		Evaluation evaluation = new Evaluation(trainingSet);
 
		model.buildClassifier(trainingSet);
		evaluation.evaluateModel(model, testingSet);
 
		return evaluation;
	}
 
	public static double calculateAccuracy(FastVector predictions) {
		double correct = 0;
 
		for (int i = 0; i < predictions.size(); i++) {
			NominalPrediction np = (NominalPrediction) predictions.elementAt(i);
			if (np.predicted() == np.actual()) {
				correct++;
			}
		}
 
		return 100 * correct / predictions.size();
	}
 
	public static Instances[][] crossValidationSplit(Instances data, int numberOfFolds) {
		Instances[][] split = new Instances[2][numberOfFolds];
 
		for (int i = 0; i < numberOfFolds; i++) {
			split[0][i] = data.trainCV(numberOfFolds, i);
			split[1][i] = data.testCV(numberOfFolds, i);
		}
 
		return split;
	}
        
        public static Instances dBDataInstances(String dbQuery,String user,String pass) throws Exception{
            InstanceQuery query = new InstanceQuery();
            query.setUsername(user);
            query.setPassword(pass);
            query.setQuery(dbQuery);
            // You can declare that your data set is sparse
            // query.setSparseData(true);
            Instances data = query.retrieveInstances();
            return data;
        }
        
        public static Instances convertNumericToNominal(Instances originalData) throws Exception{
            NumericToNominal filter= new NumericToNominal();
            String[] options= new String[2];
            options[0]="-R";
            options[1]="first-last";  //range of variables to make nominal

            filter.setOptions(options);
            filter.setInputFormat(originalData);

            Instances newData=Filter.useFilter(originalData, filter);
            
            return newData;

        }
        
        public static Instances convertStringToNominal(Instances originalData) throws Exception{
            StringToNominal filter= new StringToNominal();
            String[] options= new String[2];
            options[0]="-R";
            options[1]="first-last";  //range of variables to make nominal

            filter.setOptions(options);
            filter.setInputFormat(originalData);

            Instances newData=Filter.useFilter(originalData, filter);
            return newData;
        }
 
	public static void main(String[] args) throws Exception {
            
		//training data for Set-I data : used for kt prediction 
                BufferedReader datafile = readDataFile("AnalyKT.arff");
		//training data for Set-II data : used for TH grade prediction 
                BufferedReader thDataFile = readDataFile("AnalyTH.arff");
                
                //retreiveing instances, applying filters and setting class index(column whose values is to be predicted)
                //for Set I data
		Instances dataKT = new Instances(datafile);
		dataKT=convertNumericToNominal(dataKT);
                dataKT=convertStringToNominal(dataKT);
                dataKT.setClassIndex(dataKT.numAttributes() - 3);

                //retreiveing instances, applying filters and setting class index(column whose values is to be predicted)
                //for Set II data
                Instances dataTh = new Instances(thDataFile);
		dataTh=convertNumericToNominal(dataTh);
                dataTh=convertStringToNominal(dataTh);
                dataTh.setClassIndex(dataTh.numAttributes() - 4);
 

		//Building Naive Bayes Model and evaluate it by 10-fold cross validation for accuracy
		Classifier nB1 = new NaiveBayes();
		Evaluation evalNB = new Evaluation(dataKT);
		evalNB.crossValidateModel(nB1, dataKT, 10, new Random(1));
		System.out.println("<div style='clear:both;'>");
		System.out.println("Estimated Accuracy Naive Bayes (KT Prediction): "+Double.toString(evalNB.pctCorrect()));
                
                //Building JRip Model and evaluate it by 10-fold cross validation for accuracy
                Classifier jR1 = new JRip();
		Evaluation evalJRip = new Evaluation(dataTh);
		evalJRip.crossValidateModel(jR1, dataTh, 10, new Random(1));
		System.out.println("Estimated Accuracy JRip (TH grade Prediction): "+Double.toString(evalJRip.pctCorrect()));

                //Train a new classifier
		Classifier nB2 = new NaiveBayes();
		nB2.buildClassifier(dataKT);  //predict KT with this model
                evalNB = new Evaluation(dataKT);
                
                //Train a new classifier JRip
		Classifier jR2 = new JRip();
		jR2.buildClassifier(dataTh);  //predict TH grade with this model
                evalJRip=  new Evaluation(dataTh);

                //Query for retrieving Set I data for KT prediction
                String query="select Student.rollno as rollno, study_hrs, health, tution, source_fees, drop_yr, campus_feedback,travel_time, " +
                                "family_type, annual_income,father_edu,mother_edu,father_occup,mother_occup, challenges_family,cast, " +
                                "mother_tounge,kts,ssc,hsc,medium,location,trav_medium, gender, course_id,kt,att,test " +
                                "from Student natural join StudentDetails inner join Stud_Kt_Def using(rollno)";
		Instances testKtData=dBDataInstances(query, "root", "root");
                //Converting attributes to nominal
                testKtData=convertNumericToNominal(testKtData);
                testKtData=convertStringToNominal(testKtData);
                //setting class index to predict kt column value
                testKtData.setClassIndex(testKtData.numAttributes() - 3);
                //printing number of attributes in Set-I data
                System.out.println("Number of Attributes Set-I:  Test Data:"+testKtData.numAttributes()+" Training Data:"+dataKT.numAttributes());
                
                
                //Query for retrieving Set II data for grade_individual prediction
                query="select Student.rollno as rollno, study_hrs, health, tution, source_fees, drop_yr, campus_feedback,travel_time, " +
                        "family_type, annual_income,father_edu,mother_edu,father_occup,mother_occup, challenges_family,cast, " +
                        "mother_tounge,kts,ssc,hsc,medium,quota,location,trav_medium, course_id,kt,att,grade_individual,tw,test,orpr " +
                        "from Student natural join StudentDetails inner join Stud_Kt_Def using(rollno)";
		Instances testThData=dBDataInstances(query, "root", "root");
                //Converting attributes to nominal
                testThData=convertNumericToNominal(testThData);
                testThData=convertStringToNominal(testThData);
                //setting class index to predict TH column value
                testThData.setClassIndex(testThData.numAttributes() - 4);
                //printing number of attributes in Set-II data
                System.out.println("Number of Attributes Set-II:  Test Data:"+testThData.numAttributes()+" Training Data:"+dataTh.numAttributes());
                
                System.out.print("</div>");
                /*if(!dataKT.equalHeaders(testKtData)){
                    System.out.println("Test and Train Data Headers are unequal");
                    System.out.println(dataKT.equalHeadersMsg(testKtData));
                    System.out.println("Exiting program");
                    System.exit(-1);
                }*/
                //System.out.println(""+testKtData.enumerateAttributes().toString()+"-\n"+dataKT.enumerateAttributes().toString());
       //         evalNB.evaluateModel(nB2, testKtData);
                
         //       System.out.println(evalNB.toSummaryString("\nResults\n======\n", false));
         
                //Predicting KT for each tuple in test data and printing it using Naive Bayes
                System.out.print("<div id='left' class='wrapper' style='width:50%;'><table><tr><th>Roll No</th><th>Course ID</th><th>Actual KT</th><th>Predicted KT</th></tr>");
                for (int i = 0; i < testKtData.numInstances(); i++) {
                     double pred = nB2.classifyInstance(testKtData.instance(i));
                     if(new String(""+testKtData.classAttribute().value((int) pred)).equals("YES")){
                        System.out.print("<tr><td>" + testKtData.instance(i).stringValue(0)+"</td>");
                        System.out.print("<td>" + testKtData.instance(i).stringValue(24)+"</td>");
                        System.out.print("<td>" + testKtData.classAttribute().value((int) testKtData.instance(i).classValue())+"</td>");
                        System.out.print("<td>" + testKtData.classAttribute().value((int) pred)+"</td></tr>");
                    }
                }
                System.out.print("</table></div>");
                //Predicting TH grade for each tuple in test data and printing it using JRip
                System.out.print("<div id='right' class='wrapper' style='width:50%;'><table><tr><th>Roll No</th><th>Course ID</th><th>Actual Grade</th><th>Predicted Grade</th></tr>");
                for (int i = 0; i < testThData.numInstances(); i++) {
                     double pred = jR2.classifyInstance(testThData.instance(i));
                     //if(new String(""+testThData.classAttribute().value((int) pred)).equals("YES")){
                        System.out.print("<tr><td>" + testThData.instance(i).stringValue(0)+"</td>");
                        System.out.print("<td>" + testThData.instance(i).stringValue(24)+"</td>");
                        System.out.print("<td>" + testThData.classAttribute().value((int) testThData.instance(i).classValue())+"</td>");
                        System.out.print("<td>" + testThData.classAttribute().value((int) pred)+"</td></tr>");
                    //}
                }
                System.out.println("</table></div></div>");
	}
}
