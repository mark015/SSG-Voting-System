<!-- top navigation -->
<div class="top_nav hidden-print">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="fa fa-clock-o" aria-hidden="true" style="font-size: 30px; padding: 3px; margin-top: 2%"> <b><span id="timer" style="font-size: 30px; color: red;"></span></b></li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->
<script>
    var d = new Date();
    document.getElementById("date").innerHTML = d.toDateString();
</script>

<script>
    var myVar = setInterval(myTimer, 1000);
    function myTimer() {
      var d = new Date();
      document.getElementById("timer").innerHTML = d.toLocaleTimeString();
    }
</script>