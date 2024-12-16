
<input class="hidden" id="forCreate" type="checkbox" />
<div class="popUp create"> 
    <div class="popIn">
        <div class="popC">
            <div class="popH">
                <div class="t">{{ __('header.create_new') }}</div>
                <label class="c" for="forCreate"></label>
            </div>
            <div class="popB">
                <div class="c">

                    <div class="create-panel">
                        <div class="panel-stu">
                            <div class="stu-container-tabs">
                                <div class="stu-tabs tbstu">
                                    <div class="active"></div>
                                    <button name-tab="tbstu" class="a">STU</button>
                                    <button name-tab="tbnote">NOTE</button>
                                </div>
                                <div class="stu-tab-ctns">
                                    <div class="stuContainer">
                                        <div class="stu_cnt" id="CREATE_STU"></div>
                                    </div>
                                    <div class="noteContainer">
                                        <div class="stu_cnt" id="CREATE_NOTE"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <label class="fc" for="forCreate"></label>
</div>

<script>
    const btns = document.querySelectorAll(".stu-tabs button");
    const active = document.querySelector(".stu-tabs .active");

    for (let i = 0; i < btns.length; i++) {
        btns[i].onclick = function () {
            btns.forEach(btn => {
                if (btn.classList.contains('a')) {
                    btn.classList.remove('a');
                    btn.parentNode.classList.remove(btn.getAttribute('name-tab'));
                }
            })
            btns[i].classList.add('a');
            btns[i].parentNode.classList.add(btns[i].getAttribute('name-tab'));
            let move = (100 / btns.length) * i;
            active.style.left = move + "%";
        };
    }
</script>