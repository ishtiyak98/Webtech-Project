<?php 
    if(isset($_POST['submit'])){
        if(empty($_POST['name']) || empty($_POST['id']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['pass']) || empty($_POST['cPass']) || empty($_POST['dob'])){
            echo"Plaese fill out all the field";
        }
        else{

            $name= $_POST['name'];
            $id=$_POST['id'];
            $email= $_POST['email'];
            $phone = $_POST['phone'];
            $pass = $_POST['pass'];
            $cPass=$_POST['cPass'];
            $dob=$_POST['dob'];
            move_uploaded_file($_FILES['profilePic']['tmp_name'], '../assets/'.$_FILES['profilePic']['name']);
            $profilePic='../assets/'.$_FILES['profilePic']['name'];
            $bloodGroop=$_POST['bloodGroup'];

            $user=['name'=> $name, 'id'=>$id, 'email'=> $email, 'bloodGroup'=> $bloodGroop , 'phone'=>$phone, 'pass'=>$pass, 'dob'=>$dob, 'profilePic'=>$profilePic ];

            if ($pass!=$cPass) {
                echo"please check your password and confirm password";
            }
            else{
                if(filesize('../model/teacher.json')==0){
					$json=json_encode($user);
					$myfile=fopen('../model/teacher.json', 'w');
					fwrite($myfile, '['.$json.']');
				}
				else{
					$inp = file_get_contents('../model/teacher.json');
					$tempArray = json_decode($inp);
					array_push($tempArray, $user);
					$jsonData = json_encode($tempArray);
					file_put_contents('../model/teacher.json', $jsonData);
				}
				header('location: ../view/login.html');
            }
        }
    }

?>