<div id="header-wrapper">
    <header id="header" class="container">

        <!-- Logo -->
        <div id="logo" onclick='window.location.href= "/"' style='cursor: pointer'>
            <img src="/assets/images/logo.png" alt="logo" >
        </div>

        <!-- Nav -->
        <div class='top-nav'>
            <nav id="nav">
                <ul>
                    <li class='<?php echo $c == "" ? "active" : ""; ?>'><a href="/">Home</a></li>
                    <li class='<?php echo $c == "electronics" ? "active" : ""; ?>'><a href="/category/electronics">Electronics</a></li>
                    <li class='<?php echo $c == "sports" ? "active" : ""; ?>'><a href="/category/sports">Sports</a></li>
                    <li class='<?php echo $c == "clothing" ? "active" : ""; ?>'><a href="/category/clothing">Clothing</a></li>
                    <li class='<?php echo $c == "pet" ? "active" : ""; ?>'><a href="/category/pet">Pet Supplies</a></li>
                </ul>
            </nav>
            <div style='display: inline-flex;'>
                <input type="text" id="search" placeholder="Search.." >
                <button onclick='search()' id='search-ico'> 
                    <img src="/assets/images/search.png" alt="search">
                </button>
            </div>
        </div>
    </header>
</div>