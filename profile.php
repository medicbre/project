<?php
include_once "header.php";
include "classes/dbh.class.php";
include "classes/profileinfo.classes.php";
include "classes/profileinfo-view.classes.php";
$profileInfo = new ProfileinfoView();
?>
<link rel="stylesheet" href="css/mdb.min.css">
<link rel="stylesheet" href="profile.css">
<div class="container mt-5">
    
    <div class="row d-flex justify-content-center">
        
        <div class="col-md-7">
            
            <div class="card p-3 py-4">
                
                <div class="text-center">
                    <img src="https://i.imgur.com/bDLhJiP.jpg" width="100" class="rounded-circle">
                </div>
                
                <div class="text-center mt-3">
                    <span class="bg-secondary p-1 px-4 rounded text-white">Pro</span>
                    <h2 class="mt-2 mb-0">
                        <?php
                            $profileInfo->fetchTitle($_SESSION["userid"]);
                        ?>
                    </h2>
                    <span>UI/UX Designer</span>
                    <hr>
                    
                    <div class="px-4 mt-1">
                        <h2>About me</h2>
                        <p class="fonts">
                            <?php
                                $profileInfo->fetchAbout($_SESSION["userid"]);
                            ?>

                        </p>
                        <hr>
                    
                    </div>

                    <div class="px-4 mt-3">
                        <h3>Profile intro</h3>
                        <p class="fonts">
                        <?php
                                $profileInfo->fetchText($_SESSION["userid"]);
                            ?>
                        </p>
                        <hr>
                    </div>
                    
                     <ul class="social-list">
                        <li><i class="fa fa-facebook"></i></li>
                        <li><i class="fa fa-dribbble"></i></li>
                        <li><i class="fa fa-instagram"></i></li>
                        <li><i class="fa fa-linkedin"></i></li>
                        <li><i class="fa fa-google"></i></li>
                    </ul>
                    
                    <div class="buttons">
                        
                        <button class="btn btn-outline-primary px-4">Message</button>
                        <br><br>
                        <form action="profilesettings.php" method="GET">
                        <button type="submit" class="btn btn-primary px-4 ms-3">Profile settings</button>
                    </form>
                    </div>
                    
                    
                </div>
                
               
                
                
            </div>
            
        </div>
        
    </div>
    
</div>
