<? php 
$dbhost='localhost';
$dbname='mydb';
$dbusername='root';
$dbpassword='';
$conn=  mysql_connect($dbhost,$dbusername,$dbpassword,$dbname);

if(isset($_POST['submit'])

    //if(!empty($_POST['name']) && !empty($_POST['title']) && !empty($_POST['schoolname']) && !empty($_POST['review']))
    {
       $name = $_POST['name'];
       $title = $_POST['title'];
       $schoolname = $_POST['schoolname'];
       $review = $_POST['review'];

       $query = "insert into fback(name,title,schoolname,review) values('$name' , '$title','$schoolname','$review')" ;

       $run = mysqli_query($conn,$query) or die(mysqli_error());

       if($run){
           echo "thanks for your Feedback.....";
       }
       else {
           echo"form not submitted" ;
               }
    }
   // else{
    //    echo "all fields required";
   // }
    mysqli_close($conn);
)
?>