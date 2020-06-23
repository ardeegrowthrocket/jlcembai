<?php
session_start();
require_once("./connect.php");
require_once("./function.php");
?>
<style>
#dataTables-example_filter , #dataTables-example_info , #dataTables-example_wrapper .row
{
    display:none;
}

.fa-2{
  font-size: 72px;
}

ul.menuboard li {
  float:left;
  width:19%;
  list-style: none;
  text-align: center;
  height: 128px;
}
</style>
<h1>Dashboard</h1>
<div class="panel panel-default">
   <div class="panel-body">  
      
      <ul class='menuboard'>
        <li>
          <a href='index.php?pages=company'>
          <i class="fa fa-rocket fa-2" aria-hidden="true"></i>
          <br/>
          <span>Company Status</span>
          </a>
        </li>

        <li>
          <a href='index.php?pages=editprofile'>
          <i class="fa fa-user-circle fa-2" aria-hidden="true"></i>
          <br/>
          <span>My Account - Edit Profile</span>
          </a>
        </li>

        <li>
          <a href='index.php?pages=changepassword'>
          <i class="fa fa-lock fa-2" aria-hidden="true"></i>
          <br/>
          <span>My Account - Change Password</span>
          </a>
        </li>



      <?php if($_SESSION['role']!=2)
      { 
      ?>
        <li>
          <a href='index.php?pages=users'>
          <i class="fa fa-users fa-2" aria-hidden="true"></i>
          <br/>
          <span>Admin Accounts</span>
          </a>
        </li>

        <li>
          <a href='index.php?pages=members'>
          <i class="fa fa-users fa-2" aria-hidden="true"></i>
          <br/>
          <span>Members Account</span>
          </a>
        </li>

        <li>
          <a href='index.php?pages=expenses'>
          <i class="fa fa-shopping-cart fa-2" aria-hidden="true"></i>
          <br/>
          <span>Expenses Manager</span>
          </a>
        </li>


        <li>
          <a href='index.php?pages=files'>
          <i class="fa fa-files-o fa-2" aria-hidden="true"></i>
          <br/>
          <span>File Manager</span>
          </a>
        </li>


        <li>
          <a href='index.php?pages=system'>
          <i class="fa fa-wrench fa-2" aria-hidden="true"></i>
          <br/>
          <span>Website and System Configuration</span>
          </a>
        </li>
      <?php
      }
      ?>
        

      </ul>
</div>
</div>


<div class="panel panel-default">
   <div class="panel-body">  
      

      <ul class='menuboard'>


        <li>
          <a href='index.php?pages=report&task=dailycollect'>
          <i class="fa  fa-line-chart fa-2" aria-hidden="true"></i>
          <br/>
          <span>Daily Collection Report</span>
          </a>
        </li>

        <li>
          <a href='index.php?pages=report&task=jlcdaily'>
          <i class="fa  fa-line-chart fa-2" aria-hidden="true"></i>
          <br/>
          <span>JLC Collection Report</span>
          </a>
        </li>

        <li>
          <a href='index.php?pages=report&task=loanrelease'>
          <i class="fa fa-pie-chart fa-2" aria-hidden="true"></i>
          <br/>
          <span>Loan Release Report</span>
          </a>
        </li>

        <li>
          <a href='index.php?pages=report&task=loanbalance'>
          <i class="fa fa-balance-scale fa-2" aria-hidden="true"></i>
          <br/>
          <span>Loan Balance Report</span>
          </a>
        </li>


        <li>
          <a href='index.php?pages=report&task=delays'>
          <i class="fa fa-exclamation-triangle fa-2" aria-hidden="true"></i>
          <br/>
          <span>Payment Delays Report</span>
          </a>
        </li>



        <li>
          <a href='index.php?pages=report&task=withdraw'>
          <i class="fa fa-credit-card fa-2" aria-hidden="true"></i>
          <br/>
          <span>Withdrawals Report</span>
          </a>
        </li>



        <li>
          <a href='index.php?pages=report&task=expenses'>
          <i class="fa fa-shopping-basket fa-2" aria-hidden="true"></i>
          <br/>
          <span>Expenses Report</span>
          </a>
        </li>



         <li>
          <a href='index.php?pages=report&task=cashflow'>
          <i class="fa fa-bar-chart fa-2" aria-hidden="true"></i>
          <br/>
          <span>Cash Flow Monitoring</span>
          </a>
        </li>  


        <li>
          <a href='index.php?pages=report&task=cf'>
          <i class="fa fa-bar-chart fa-2" aria-hidden="true"></i>
          <br/>
          <span>Cash Monitoring Records</span>
          </a>
        </li>

        <li>
          <a href='index.php?pages=report&task=licollections'>
          <i class="fa fa-shield fa-2" aria-hidden="true"></i>
          <br/>
          <span>Life Insurances Collections Reports</span>
          </a>
        </li>


        <li>
          <a href='index.php?pages=report&task=limembers'>
          <i class="fa fa-shield fa-2" aria-hidden="true"></i>
          <br/>
          <span>Life Insurances Members Record</span>
          </a>
        </li>

        <li>
          <a href='index.php?pages=report&task=offset'>
          <i class="fa fa-user-times  fa-2" aria-hidden="true"></i>
          <br/>
          <span>Offset Users</span>
          </a>
        </li>


      </ul>
</div>
</div>


