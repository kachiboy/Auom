<?php
    require_once('includes/connect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Automated</title>
    <link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/admin.css">
    
</head>
<body>
<!-- <h1>Welcome to the Admin Page</h1> -->
    <header>
        <div class="logo">
            <a onclick="hide()" href="">Dashboard</a> 
            
        </div>
        <nav class="big-header">
            <!-- <div class="searchbar">
                <input type="search" name="" placeholder="Search for users" id="">
            </div>
            <div class="submitbtn">
                <input type="submit" value="Search">
            </div> -->
            <div class="adminpost">
                <i class="fa fa-user"></i>
                <span>AdminPanel</span>
                    
            </div>
            <div class="language">
                <select name="" id="">
                    <option value="">Select Language</option>
                    <option value="">english</option>
                    <option value="">spanish</option>
                    <option value="">russian</option>
                    <option value="">chinese</option>
                    <option value="">french</option>
                    <option value="">turkish</option>
                    <option value="">german</option>
                    <option value="">italian</option>
                    <option value="">greek</option>
                    <option value="">latin</option>
                </select>
            </div>
            <div class="adminlogout-btn">
                <a href="adminlogin.html">Logout</a>
            </div>
        </nav>
    </header>

    <nav class="big-sidebar">
        <div class="left-sidebar">
            <li>
                <a href="admin.php">
                    <i class="fa fa-pie-chart"></i>    
                    <p>Admin Dashboard</p> 
                </a>
            </li>
        
            
            <li>
                <a href="manage_department.php">
                    <i class="fa fa-sitemap"></i>    
                    <p>Department</p> 
                </a>
            </li>

            <li>
                <a  href="manage_doctor.php">
                    <i class="fa fa-user-md"></i>
                    <p>Doctor</p> 
                </a>
            </li>

            <li>
                <a href="manage_inpatient.php">
                    <i class="fa fa-user"></i>
                    <p>Inpatient</p>
                </a>
            </li>

            <li>
                <a href="manage_outpatient.php">
                    <i class="fa fa-user"></i>
                    <p>Outpatient</p>
                </a>
            </li>

            <li>
                <a  href="manage_nurse.php">
                    <i class="fa fa-plus"></i>
                    <p>Nurse</p>
                </a>
            </li>

            <li>
                <a  href="manage_pharmacist.php">
                    <i class="fa fa-medkit "> </i>
                    <p>Pharmacist</p> 
                </a>
            </li>


            <li class = "has-sub"><a href="#"><i class="fa fa-wrench "></i><p>Settings</p><i class = "fa fa-arrow"></i></a>
                <ul>
                    <li><a class = "current_sub" href="manage_noticeboard.php"><i class = "fa fa-columns"></i><p>Manage Noticeboard</p></a></li>
                    <li><a href="backup_restore.php"><i class = "fa fa-download"></i><p>Backup Restore</p></a></li>
                </ul>
            </li>


            <li>
                <a href="manage_profile.php">
                    <i class="fa fa-lock "> </i>
                    <p>Profile</p> 
                </a>
            </li>
        
        </div>
        <div class="main-content">
            <div class="main-wrapper">
                <div class="infotab">
                    <i class="fa fa-info-circle"></i>
                    Manage Noticeboard
                </div>
                <div class="tablelist">  
                    <div id="tab-hide1" class="table-tab" >
                        <li id="tab1" class="tab-one">
                            <a class="tab-on" href="">
                                <i class="fa fa-align-justify"></i>
                                <span>Noticeboard List</span>
                            </a>
                        </li>
                      
                        <li id="tab2" class="tab-two">
                            <a  href="">
                                <i class="fa fa-plus"></i>
                                <span>Add Noticeboard</span>
                            </a>
                        </li>
                    </div>

                    <div id="tab-hide2" class="table-tab" >
                        <li id="tab1" class="tab-one-new">
                            <a  class="tab-on" href="">
                                <i class="fa fa-square "></i>
                                <span >Noticeboard List</span>
                            </a>
                        </li>
                        
                        <li id="tab2" class="tab-two-new">
                            <div class="tab-two-new-content">
                                <a href="">
                                    <i class="fa fa-plus"></i>
                                    <span>Add Noticeboard</span>
                                </a>
                            </div>
                            
                        </li>
                    </div>

                    <div class="table-wrapper" id="display1">
                            <div class="table-wrapper-header">
                                <div class="searchbar-fill">
                                    <form class = "searchbar" method="post" >
                                        <span>Search:</span>
                                            <input type="search" name="search" placeholder="Search for users" id="">
                                                <span class = "search-btn">
                                                    <input type="submit" value="" > <i class = "fa fa-search"></i>
                                                </span>
                                    </form>
                                </div>
            
                                <div class="show-entries">
                                    <span>show</span>
                                    <div class="show-bar">
                                        <select name="state" id="maxRows">
                                            <option value="50">Show All</option>
                                            <option value="3">3</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                        </select>
                                    </div>
                                    <span>entries</span> 
                                </div>
                            </div>

                            <div id = "notice">
                                <?php
                                    if(isset($_POST['search'])){
                                        $name = $_POST['search'];
                                    }else{ $name = '';}
                                    $query = "SELECT * FROM t_noticeboard WHERE CONCAT(no_title,' ',no_notice) LIKE '%$name%' ORDER BY NoticeboardID ASC";
        
                                    $response = @mysqli_query($connect,$query);
        
                                    if ($response) {
                                        echo'<table id="mytable" border="1">
                                        <thead>
                                            <tr>
                                                <th>#<i class="fa fa-sort-up"></i></th>
                                                <th>S/N<i class="fa fa-sort-up"></i></th>
                                                <th>Title <i class="fa fa-sort"></i></th>
                                                <th>Notice<i class="fa fa-sort"></i></th>
                                                <th>Date<i class="fa fa-sort"></i></th>
                                                <th>Options<i class="fa fa-sort"></i></th>
                                            </tr>
                                        </thead>';
                                        $counter = 1;
                                    while ($row = mysqli_fetch_array($response)) {
                                        echo '<tbody>';
        
                                        
                                        echo'<tr>';
                                        echo'<td>  <input type="checkbox" name="" id=""> </td>';
                                        echo '<td>'.$counter.'</td>';
                                        echo
                                        '<td>'.$row['no_title'].'</td>'.
                                        '<td>'.$row['no_notice'].'</td>'.
                                        '<td>'.$row['no_date'].'</td>';
                                        echo   '<td>
                                                    <div class = "table_btns">
                                                        <div class = "updatebtn" href="#">
                                                            <i class="fa fa-wrench"></i>
                                                        </div>    
                                                        <div class="delbtn" onClick="showDelete(\''.$row['no_title'].' '.$row['no_notice'].'\',\''.$row['NoticeboardID'].'\')" href="">
                                                            <i class="fa fa-trash-o "></i>
                                                        </div>
                                                    </div>
                                                </td>';
                                        echo'</tr>';
                                        echo '</tbody>';
                                        $counter++;
                                    }
                                        
                                        echo "</table>";
                                    }
                                    else {
                                        echo "Error retrieving data";
                                        echo mysqli_error($connect);
        
                                    }
                                    mysqli_close($connect);
                                    
        
                                ?>
                            </div>
    
                            
                            
                            <div class="table-footer">
                                <div class="show-note">
                                    <p>Showing 1 to 3 of 3 entries</p>
                                </div>
                                <div class="pagination-wrapper">
                                    <div>
                                        <button>First</button>
                                    </div>
                                    <div>
                                        <button>Previous</button>
                                    </div>
                                    <div>
                                        <button>1</button>
                                    </div>
                                    <div>
                                        <button>Next</button>
                                    </div>
                                    <div>
                                        <button>Last</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                    
                    

                    <div class="table-wrapper" id="display2">
                        
                            <form class="adding-form" action="includes/insertNotice.php" method="post">
                                <div>
                                    Title: <input type="text" name="title" id="title" placeholder="title">
                                </div>

                                <div>
                                    Notice: <input type="text" name="notice" id="notice" placeholder="notice">
                                </div>

                                <div>
                                    Date: <input type="date" name="date" id="date">
                                </div>

                                <div class="table-footer">
                                    <div class="table-footer-btn">
                                        <input type="submit" name = "submit" value="Add Noticeboard">
                                    </div>
                                    
                                </div>
                            </form>
                    </div>

                    <div id = "success">

                    </div>

                    <div class = "invisible_drop"></div>
                        <div class = "prompt_box">
                            <h2>Are you Sure you want to Delete? </h2><br>
                            <div id="users_name"></div>
                            <div id="user_id">
                                
                            </div>
                            <div class = "prompt_btn">
                                <button Onclick = "yes_btn" id = "yes_btn">Yes</button>
                                <button Onclick = "no_btn" id = "no_btn">No</button>
                            </div>
                        </div>


                </div>
            </div>
            
            
        </div>
    </nav>

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/notice.js"></script>
    <script type="text/javascript">
        $(document).ready(function(e){
            $(".has-sub").click(function(){
                $(this).toggleClass('tap');
            });
                
            
        });

        // var table = '#mytable'
        // $('#maxRows').on('change', function () {
        //     $('.pagination').html('')
        //     var trnum = 0
        //     var maxRows = parseInt($(this).val())
        //     var totalRows = $(table+' tbody tr').length
        //     $(table +' tr:gt(0)').each(function () {
        //         trnum++
        //         if (trnum > maxRows) {
        //             $(this).hide()
        //         }
        //         if (trnum <= maxRows) {
        //             $(this).show()
        //         }
        //     })
        //     if (totalRows > maxRows) {
        //         var pagenum = Math.ceil(totalRows/maxRows)
        //         for(var i = 1; i <= pagenum;){
        //             $('.pagination').append('<li data-page = "'+i+'">\<span>' + i++ +'<span class = "sr-only">(current)</span></span>\</li>').show()
        //         }
        //     }

        //     $('.pagination li:first-child').addClass('active')
        //     $('.pagination li').on('click', function(){
        //         var pageNum = $(this).attr('data-page')
        //         var trIndex = 0;
        //         $('pagination li').removeClass('active')
        //         $(this).addClass('active')
        //         $(table+'tr:gt(0)').each(function () {
        //             trIndex++
        //             if(trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
        //                 $(this).hide()
        //             }else{
        //                 $(this).show()
        //             }
        //         })
        //     })
        // })
        // $(function(){
        //     $('table tr:eq(0)').prepend('<th>ID</th>')
        //     var id = 0;
        //     $('table tr:gt(0)').each(function () {
        //         id++
        //         $(this).prepend('<td>'+id+'</td>')
        //     })
        // })
       
        
    </script>    
</body>
</html>