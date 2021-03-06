<nav class="navbar-default navbar-side" role="navigation">
   <div class="sidebar-collapse">
      <ul class="nav" id="main-menu">
         <li class="text-center">
           <img src="logo.png" class="user-image img-responsive"/>
            <div style='  color: white;text-align: left;margin-left: 9px;'>
               <br/>
               Username: <?php echo $_SESSION['username']; ?>
               <br/>
               <?php if($_SESSION['role']==1){ echo "Role: Administrator"; } else { echo "Role :Teller"; }?>
               <br/>
               <?php
               $stores = (getarrayconfig('stores'));
               ?>     
               Branch: <?php echo $stores[$_SESSION['stores']]; ?>
               



            </div>
            <br/>
         </li>
         <li>
            <a class="active-menu" href="index.php"><i class="fa fa-home fa-3x"></i>Dashboard</a>
         </li>
         <li>
            <a href="#"><i class="fa fa-user fa-3x"></i>My Account<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
               <li>
                  <a href="index.php?pages=editprofile">Edit Information</a>
               </li>
               <li>
                  <a href="index.php?pages=changepass">Change Password</a>
               </li>
            </ul>
         </li>
			<?php if($_SESSION['role']!=2)
			{ 
			?>
				 <li class="">
					<a href="#"><i class="fa fa-wrench fa-3x"></i>Administration<span class="fa arrow"></span></a>
					<ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
					   <li>
						  <a href="index.php?pages=users">Users</a>
					   </li>      
                  <li>
                    <a href="index.php?pages=members">Members</a>
                  </li> 


                  <li>
                    <a href="index.php?pages=expenses">Expenses</a>
                  </li>

                  <li>
                    <a href="index.php?pages=files">Files</a>
                  </li>

                  <li>
                    <a href="index.php?pages=system">System Config</a>
                  </li>
					</ul>
				 </li>			
			<?php
			}
			?>

         <li>
            <a href="#"><i class="fa fa-bar-chart fa-3x"></i>Reports<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
               <li>
                  <a href="index.php?pages=report&task=dailycollect">Daily Collection</a>
               </li>
               <li>
                  <a href="index.php?pages=report&task=jlcdaily">JLC Collection</a>
               </li>
               <li>
                  <a href="index.php?pages=report&task=loanrelease">Loan Release</a>
               </li>
               <li>
                  <a href="index.php?pages=report&task=loanbalance">Loan Balance</a>
               </li>
               <li>
                  <a href="index.php?pages=report&task=delays">Delay</a>
               </li>
               <li>
                  <a href="index.php?pages=report&task=withdraw">Withdrawals</a>
               </li>
               <li>
                  <a href="index.php?pages=report&task=expenses">Expenses</a>
               </li>
               <li>
                  <a href="index.php?pages=report&task=cashflow">Cash Monitoring</a>
               </li>
               <li>
                  <a href="index.php?pages=report&task=cf">Cash Monitoring Records</a>
               </li>
               <li>
                  <a href="index.php?pages=report&task=offset">Offset Records</a>
               </li>

            </ul>
         </li>

         <li>
            <a href="#"><i class="fa fa-university fa-3x"></i>Life Insurance<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse" aria-expanded="false" style="height: 0px;">
               <li>
                  <a href="index.php?pages=report&task=licollections">LI Collection</a>
               </li>
               <li>
                  <a href="index.php?pages=report&task=limembers">LI Members</a>
               </li>

            </ul>
         </li>

         <li>
            <a href="logout.php"><i class="fa fa-sign-out fa-3x"></i>Logout</a>
         </li>
      </ul>
   </div>
</nav>
<!-- /. NAV SIDE  -->