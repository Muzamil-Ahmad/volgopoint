@include('partials.header')
@include('partials.sidenav')
@yield('content')       
@include('partials.footer')
<script>
        
        
// $(function() {
//     $.ajax({
//         type: 'GET',
//         url: "{{ url('api/auth/user') }}",
//         dataType:'JSON',
//         headers: { "Authorization": "Bearer " + localStorage.getItem("token"},
//         success:function(response){
//               console.log(response);
//             },
//         error:function(response){
//             console.log('welcome')
//            console.log("error",response);
//         }  
//     });
// });
        $('#setUsername').html(localStorage.getItem('username'));
        function logout(){
                   $.ajax({
                        type: 'GET',
                        url: "{{ url('api/logout') }}",
                        dataType:'JSON',
                        headers: { "Authorization": "Bearer " + localStorage.getItem("token")},
                        success:function(response){
                                localStorage.removeItem("token");
                                localStorage.removeItem("dp");
                                window.location = "{{ url('admin') }}";
                        console.log(response);
                        },
                        error:function(response){
                        console.log('welcome')
                        console.log("error",response);
                        }  
                });
        }
        </script>