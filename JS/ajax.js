$(document).ready(function(){
    //show all users on UI
    function showAllUsers(){
        $.ajax({
            url : "action.php",
            type : "POST",
            data : {action : "view"},
            success : function(result){
                $("#tbody").html(result)
            }
        })
    }
    showAllUsers();



    //insert user 
    $("#btnadd").click(function(e){
        let uid = $("#uid").val();
        let uname = $("#nameid").val();
        let uemail = $("#emailid").val();
        let uage = $("#ageid").val();
        let ugender = $("#genderid").val();
        let dataobj = {id: uid,name: uname, email: uemail, age: uage, gender: ugender, action: "insert"};

        e.preventDefault();

        $.ajax({
            url : "action.php",
            type : "POST",
            data : dataobj,  //pass js obj and php get it as associative array
            success : function(data){
            data = data.trim()
            $("#msg").html(data).show();
            if(data === "User data inserted successfully"){
                $("#myform").trigger("reset");
                showAllUsers();
               }
            }
        })
    })




//delete
    $("tbody").on("click",".delete",function(e){
        e.preventDefault()
        let uid = $(this).attr("data-uid")
        $.ajax({
            url : "action.php",
            type : "POST",
            data : {id : uid, action: "delete"},
            success : function(data){
                $("#msg").html(data).show();
                showAllUsers()
            }
        })
    })



//edit
    $("tbody").on("click",".edit",function(e){
        e.preventDefault()
        let uid = $(this).attr("data-uid")
        $.ajax({
            url : "action.php",
            type : "POST",
            dataType : "json",
            data : {id : uid, action : "edit"},
            success : function(data){
                $("#uid").val(data[0].id);
                $("#nameid").val(data[0].name);
                $("#emailid").val(data[0].email);
                $("#ageid").val(data[0].age);
                $("#genderid").val(data[0].gender);
            }
        })
    })



})