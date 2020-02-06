<script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
<style>
    .col-25 {
        float: left;
        width: 200px;
    }
</style>

<h3>Login</h3>
<div class="row" style="margin-top: 10px;">
    <div class="col-25">
        User: 
    </div>
    <div>
        <input id="account_name" type="text">
    </div>
</div>
<div class="row" style="margin-top: 10px;">
    <div class="col-25">
        Password: 
    </div>
    <div>
        <input id="login-password" type="password">
    </div>
</div>
<div class="row" style="margin-top: 10px;">
    <div class="col-25">
        <button id="btn-login">Login</button>
    </div>
</div>

<br />
<br />
<br />
<h3>Create An Account</h3>
<div class="row" style="margin-top: 10px;">
    <div class="col-25">
        New Name: 
    </div>
    <div>
        <input id="name" type="text">
    </div>
</div>
<div class="row" style="margin-top: 10px;">
    <div class="col-25">
        Password: 
    </div>
    <div>
        <input id="password" type="password">
    </div>
</div>
<div class="row" style="margin-top: 10px;">
    <div class="col-25">
        Re-confirm Password
    </div>
    <div>
        <input id="r-password" type="password">
    </div>
</div>
<div class="row" style="margin-top: 10px;">
    <div class="col-25">
        <button id="btn-submit">Submit</button>
    </div>
</div>

<script>
    $("#btn-login").click(function() {
        if($("#account_name").val() == "" || $("#login-password").val() == "") {
            alert("Please fill in all fields");
            return false;
        }
        
        var formData = new FormData();
        formData.append("account_name", $('#account_name').val());
        formData.append("password", $('#login-password').val());
        
        $.ajax({
            type: 'POST',
            url: '<?= base_url() ?>business/login',
            dataType: 'json',
            data: formData,
            processData: false, 
            contentType: false,
            success: function(resp) {
                if(resp.status == 1) {
                    location = '<?= base_url() ?>web/createName';
                } else {
                    alert(resp.data);
                    return false;
                }
            },
            error: function() {
                alert("System Error");
            }
        });
    });
    $("#btn-submit").click(function() {
        if($("#name").val() == "" || $("#password").val() == "" || $("#r-password").val() == "") {
            alert("Please fill in all fields");
            return false;
        }
        if($("#password").val() != $("#r-password").val()) {
            alert("Please reconfirm your password");
            return false;
        }
        
        var formData = new FormData();
        formData.append("name", $('#name').val());
        formData.append("password", $('#password').val());
        
        $.ajax({
            type: 'POST',
            url: '<?= base_url() ?>business/createUser',
            dataType: 'json',
            data: formData,
            processData: false, 
            contentType: false,
            success: function(resp) {
                alert(resp.data);
                if(resp.status == 1) {
                    location = '<?= base_url() ?>web/createName';
                } else {
                    return false;
                }
            },
            error: function() {
                alert("System Error");
            }
        });
    });
</script>

