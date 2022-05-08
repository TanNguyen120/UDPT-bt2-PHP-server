<?php
    class UserController{
        public function toLoginPage(){
            $data = " !!! Fill Your Account Detail On The Form Below !!!!";
            $VIEW = "./view/loginPage.phtml";
            require("./template/template.phtml");
        }
        public function createUser($username, $password){
            $user = new UserModel();
            $user->name = $username;
            $hashPass = password_hash($password, PASSWORD_BCRYPT);
            $user->password = $hashPass;
            $user->status = "user";
            $result = $user->insert($user);
            if($result){
                echo "Successfully created!";
            }else{
                echo "Failed to create!";
            }
        }
        
        public function formLogin()
        {
            if(isset($_REQUEST["username"]) && isset($_REQUEST["password"]))
            {
                $password = $_REQUEST["password"];
                $username = $_REQUEST["username"];
                $saveData = UserModel::findByName($username);
                if($saveData)
                {
                    $hashPass = $saveData->password;
                    if(password_verify($password, $hashPass))
                    {
                        
                        $_SESSION["user"] = $saveData->name;
                        $VIEW = "./view/mainPage.phtml";
                        require("./template/template.phtml");
                    }else{
                        $data = "!!!!!!!!! Wrong password !!!!!!!!!!";
                        $VIEW = "./view/loginPage.phtml";
                        require("./template/template.phtml");
                    }
                }else{
                    $data = "!!!!!!!!! Imaginary Account !!!!!!!!!!";
                    $VIEW = "./view/loginPage.phtml";
                    require("./template/template.phtml");
                }
            }
        }

    }


?>