  <!-- Footer -->
  <div class="hk-footer-wrap container">
                <footer class="footer">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <p>Powered by<a href="#" class="text-dark" >Brothercart</a> © 2020</p>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <p class="d-inline-block">Follow us</p>
                            <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-facebook"></i></span></a>
                            <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-twitter"></i></span></a>
                            <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-google-plus"></i></span></a>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->

    </div>
    <!-- /HK Wrapper -->
	<script>	
     var profilePicture=localStorage.getItem('dp');
     var displaypic;
 console.log("profile pic we got:",profilePicture);
     if(profilePicture=="0"||profilePicture=="undefined")
     displaypic="{{asset('/img/avatar-1.jpg')}}";
    
      else
     displaypic="{{asset('/img/dp')}}".replace('dp',profilePicture);
               
     $(document).ready(function(){
       
 const setProfile=()=>{
    
     $("#adminprofile").attr("src",displaypic);
   
 }
 setProfile();
     });
 
	
	const Toaster=(message,color)=>{
	// let class="success";
    $.toast().reset('all');
    $("body").removeAttr('class');
    $.toast({
        heading: message,
        // text: '<p class="btn btn-primary">Successful</p>',
        position: 'top-right',
        loaderBg:'#00acf0',
        class: 'jq-toast-'+color,
        hideAfter: 3500, 
        stack: 6,
        showHideTransition: 'fade'
    });
    return false;
}
var dp=localStorage.getItem("dp");
</script>
  
    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('admin_assets/vendors/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('admin_assets/vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin_assets/vendors/jasny-bootstrap/dist/js/jasny-bootstrap.min.js')}}"></script>

    <!-- Slimscroll JavaScript -->
    <script src="{{asset('admin_assets/dist/js/jquery.slimscroll.js')}}"></script>

    <!-- Data Table JavaScript -->
    <script src="{{asset('admin_assets/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin_assets/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Fancy Dropdown JS -->
    <script src="{{asset('admin_assets/dist/js/dropdown-bootstrap-extended.js')}}"></script>

    <!-- FeatherIcons JavaScript -->
    <script src="{{asset('admin_assets/dist/js/feather.min.js')}}"></script>

    <!-- Toggles JavaScript -->
    <script src="{{asset('admin_assets/vendors/jquery-toggles/toggles.min.js')}}"></script>
    <script src="{{asset('admin_assets/dist/js/toggle-data.js')}}"></script>
	
	<!-- Counter Animation JavaScript -->
	<script src="{{asset('admin_assets/vendors/waypoints/lib/jquery.waypoints.min.js')}}"></script>
	<script src="{{asset('admin_assets/vendors/jquery.counterup/jquery.counterup.min.js')}}"></script>
	
	<!-- EChartJS JavaScript -->
    <script src="{{asset('admin_assets/vendors/echarts/dist/echarts-en.min.js')}}"></script>
    
	<!-- Sparkline JavaScript -->
    <!-- <script src="{{asset('admin_assets/vendors/jquery.sparkline/dist/jquery.sparkline.min.js')}}"></script> -->
	
	<!-- Vector Maps JavaScript -->
    <script src="{{asset('admin_assets/vendors/vectormap/jquery-jvectormap-2.0.3.min.js')}}"></script>
    <script src="{{asset('admin_assets/vendors/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{asset('admin_assets/dist/js/vectormap-data.js')}}"></script>

	<!-- Owl JavaScript -->
    <script src="{{asset('admin_assets/vendors/owl.carousel/dist/owl.carousel.min.js')}}"></script>
	
	<!-- Toastr JS -->
    <script src="{{asset('admin_assets/vendors/jquery-toast-plugin/dist/jquery.toast.min.js')}}"></script>
    
    <!-- Init JavaScript -->
    <script src="{{asset('admin_assets/dist/js/init.js')}}"></script>
    <script src="{{asset('admin_assets/dist/ejs/parsley.js')}}"></script>
     <!-- Tinymce JavaScript -->
     <script src="{{asset('admin_assets/vendors/tinymce/tinymce.min.js')}}"></script>

<!-- Tinymce Wysuhtml5 Init JavaScript -->
<script src="{{asset('admin_assets/dist/js/tinymce-data.js')}}"></script>
<script src="{{ asset('admin_assets/dist/js/sweetalert.min.js') }}"></script>
    
	<!-- <script src="{{asset('admin_assets/dist/js/dashboard-data.js')}}"></script> -->
	
</body>

</html>