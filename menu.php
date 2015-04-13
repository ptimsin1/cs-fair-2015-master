<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">

         <!-- mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     <ol class="nav navbar-nav">
<?php 

if(basename($phpSelf)=="home.php"){
    print '<li class="active"><a href="' .  $siteUrl . 'home.php">Home</a></li>';
} else {
    print '<li><a href="' .  $siteUrl . 'home.php">Home</a></li>';
} 

if(basename($phpSelf)=="about.php"){
    print '<li class="active"><a href="' .  $siteUrl . 'about.php">About</a></li>';
} else {
    print '<li><a href="' .  $siteUrl . 'about.php">About</a></li>';
} 

if(basename($phpSelf)=="judges.php"){
    print '<li class="active"><a 
href="' .  $siteUrl . 'judges.php">Judges</a></li>';
} else {
    print '<li><a 
href="' .  $siteUrl . 'judges.php">Judges</a></li>';
}

/*
if(basename($phpSelf)=="index.php"){
    print '<li class="active">Slide Show</li>';
} else {
    print '<li><a 
href="' .  $siteUrl . 'slideshow/">Slide Show</a></li>';
} 

if(basename($phpSelf)=="schedule.php"){
    print '<li class="active">Schedule</li>';
} else {
    print '<li><a 
href="' .  $siteUrl . 'schedule.php">Schedule</a></li>';
} 
*/


if(basename($phpSelf)=="sponsor.php"){
    print '<li class="active dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        Sponsors <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li class="active"><a href="' .  $siteUrl . 'sponsor.php">Sponsors List</a></li>
            <li><a href="' .  $siteUrl . 'sponsorsForm.php">Become a Sponsor</a></li>
        </ul>
        </li>';
} elseif (basename($phpSelf)=="sponsorsForm.php"){
    print '<li class="active dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        Sponsors <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="' .  $siteUrl . 'sponsor.php">Sponsors List</a></li>
            <li class="active"><a href="' .  $siteUrl . 'sponsorsForm.php">Become a Sponsor</a></li>
        </ul>
        </li>';
} else {
        print '<li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        Sponsors <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="' .  $siteUrl . 'sponsor.php">Sponsors List</a></li>
            <li><a href="' .  $siteUrl . 'sponsorsForm.php">Become a Sponsor</a></li>
        </ul>
        </li>';
}

if(basename($phpSelf)=="projects.php"){
    print '<li class="active"><a href="' .  $siteUrl . 'projects.php">Projects</a></li>';
} else {
    print '<li><a href="' .  $siteUrl . 'projects.php">Projects</a></li>';
}


if(basename($phpSelf)=="schedule.php"){
    print '<li class="active"><a href="' .  $siteUrl . 
'schedule.php">Schedule</a></li>';
} else {
    print '<li><a href="' .  $siteUrl . 'schedule.php">Schedule</a></li>';
}

/*
if(basename($phpSelf)=="projects.php"){
    print '<li class="active">Projects</li>';
} else {
    print '<li><a href="' .  $siteUrl . 'projects.php">Projects</a></li>';
}

if(basename($phpSelf)=="voting.php"){
    print '<li class="active">Voting</li>';
} else {
    print '<li><a href="' .  $siteUrl . 'voting.php">Voting</a></li>';
}
*/
if(basename($phpSelf)=="photos.php"){
    print '<li class="active"><a href="' .  $siteUrl . 'photos.php">Gallery</a></li>';
} else {
    print '<li><a href="' .  $siteUrl . 'photos.php">Gallery</a></li>';
}

/*
if(basename($phpSelf)=="calendar.php"){
    print '<li class="active">Calendar</li>';
} else {
    print '<li><a href="' .  $siteUrl . 'calendar.php">Calendar</a></li>';
}
if(basename($phpSelf)=="contact.php"){
    print '<li class="active">Contact</li>';
} else {
    print '<li><a href="' .  $siteUrl . 'contact.php">Contact</a></li>';
}
*/
?>
     </ol>
     </div>
    <!-- /.navbar-collapse -->
 </div>
</nav>
