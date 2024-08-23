<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.dropotron.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>


<script>
    function search() {
        var search = document.getElementById('search').value;
        window.location.href = "/?search=" + search;
    }

    // populate search box
    var s = new URLSearchParams(window.location.search).get('search');
    if (s) {
        document.getElementById('search').value = s;
    }


</script>