<?php
    include("include/config.inc.php");
    include("include/make_session.php");
?>
<html>
    <head>
        <title>dashboard</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/bootstrap.min.css" />
        <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
        <link rel="stylesheet" type="text/css" href="plugins/select2/css/select2.min.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
        <script src="plugins/popover/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="plugins/select2/js/select2.full.min.js"></script>
        
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="height:40px;">
      <a class="navbar-brand" href="dashboard.php">Account</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
          <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="balance_entry.php">Balance Entry <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Party</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="party.php">Party</a>
                  <a class="dropdown-item" href="view_party.php">View Party</a>
                </div>
                </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Transaction</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="transaction.php">Transaction</a>
                  <a class="dropdown-item" href="view_transaction.php">View Transaction</a>
                </div>
                </li>
              <li class="nav-item">
                <a class="nav-link" href="partywise_report.php">PartyWise Report</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="datewise_report.php">DateWise Report</a>
              </li>
              <!--<li class="nav-item">-->
              <!--  <a class="nav-link" href="bank.php">Bank Details</a>-->
              <!--</li>-->
              <li class="nav-item">
                <a class="nav-link" href="user.php">User Details</a>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php" >LOGOUT</a>
                </li>
            </ul>
          </div>
    </nav>