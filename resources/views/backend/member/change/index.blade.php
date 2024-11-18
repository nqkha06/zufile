
@extends('layouts.member')

@section('title', __('change_password.title'))

@section('content')
<div class="box">
    <div class="box-top">
        <div class="top-left">
            <div class="icon"><i class="bi bi-person"></i></div>
            <div class="title">Đổi mật khẩu</div>
        </div>
    </div>
    <div class="box-container">
        <div class="content">
            <div class="account-profile">
                <div class="account-content">
                    <form action="" method="post" class="form">
                        @csrf
                        <div class="input-box">
                            <label>Mật khẩu hiện tại <span style="color: #f1416c">*</span></label>
                            <input type="text" name="old_password" placeholder="" required="required">
                        </div>
                        <div class="input-box">
                            <label>Mật khẩu mới <span style="color: #f1416c">*</span></label>
                            <input type="password" name="new_password" placeholder="" required="required">
                        </div>
                        <div class="input-box">
                            <label>Xác nhận mật khẩu <span style="color: #f1416c">*</span></label>
                            <input type="password" name="new_password_confirmation" placeholder="" required="required">
                        </div>
                        <input class="btn-submit" type="submit" name="submit" value="Lưu lại"></input>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /*input*/
    input[disabled],input[readonly]{background:#f8f8f8;cursor:not-allowed}
    .input-box{flex-shrink:0;width:100%;max-width:100%;padding-right:calc(var(--bs-gutter-x)* .5);padding-left:calc(var(--bs-gutter-x)* .5);margin-top:var(--bs-gutter-y)}
    @media (min-width:768px){.input-box{flex:0 0 auto;width:100%}}
    div :where(.input-box input, .select-box) {
        position: relative;
        height: 40px;
        width: 100%;
        outline: none;
        font-size: 1rem;
        color: var(--color-input);
        background: var(--bg-input);
        margin-top: 7px;
        margin-bottom: 10px;
        border: 1px solid var(--border-input);
        border-radius: 6px;
        padding: 0 15px;
    }
    .input-box input:focus{box-shadow:0 1px 0 var(--bgsd-input-fc)}
    .column{--bs-gutter-x:1.5rem;--bs-gutter-y:0;display:flex;flex-wrap:wrap;margin-top:calc(-1* var(--bs-gutter-y));margin-right:calc(-.5* var(--bs-gutter-x));margin-left:calc(-.5* var(--bs-gutter-x))}
    .address:where(input,.select-box){margin-top:15px}
    .select-box select{height:100%;width:100%;outline:none;border:none;color:var(--color-input);background-color:var(--bg-input);font-size:1rem}
</style>
<script>
    const selectElmtPmt = document.getElementById('paymentMethod');
    const selectElmtBkN = document.getElementById('name-bank');
    const sqIpunt = document.getElementsByName('payment_bank_name')[0];
    
    selectElmtPmt.addEventListener('change', function() {
        let val = selectElmtPmt.value;
        if (val == 2) {
            selectElmtBkN.style.display = 'block';
            selectElmtBkN.style.animation = 'fadeIn .7s forwards'
            sqIpunt.setAttribute("required", "required");
        } else {
            selectElmtBkN.style.display = 'none';
            sqIpunt.removeAttribute("required");
            sqIpunt.removeAttribute("value");
        }
        
    });
    
    function ktra() {
      var slElement = document.getElementById('pay-mtd'),
      ckUseBank = slElement.options[slElement.selectedIndex].value
      return ckUseBank
    }
</script>

@endsection
