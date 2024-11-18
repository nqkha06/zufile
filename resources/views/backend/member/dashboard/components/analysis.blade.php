<div class="container-anal">
    <div class="box-anal">
        <div class="box-anal-left">
            <i class="bi bi-eye-fill"></i>
        </div>
        <div class="box-anal-right">
            <div class="box-anal-body">
                <div class="body-number">{{ $statistic['total_clicks'] }}</div>
                <div class="box-anal-tilte">{{__(('overview.view'))}}</div>
            </div>
        </div>
    </div>
    <div class="box-anal">
        <div class="box-anal-left">
            <i class="bi bi-wallet-fill"></i>
        </div>
        <div class="box-anal-right">
            <div class="box-anal-body">
                <div class="body-number">${{ $statistic['total_revenue'] }}</div>
                <div class="box-anal-tilte">{{__(('overview.revenue'))}}</div>
            </div>
        </div>
    </div>
    <div class="box-anal">
        <div class="box-anal-left">
            <i class="bi bi-percent"></i>
        </div>
        <div class="box-anal-right">
            <div class="box-anal-body">
                <div class="body-number">${{ $statistic['cpm'] }}</div>
                <div class="box-anal-tilte">{{__(('overview.cpm'))}}</div>
            </div>
        </div>
    </div>
    <div class="box-anal">
        <div class="box-anal-left">
            <i class="bi bi-people-fill"></i>
        </div>
        <div class="box-anal-right">
            <div class="box-anal-body">
                <div class="body-number">0</div>
                <div class="box-anal-tilte">{{__(('overview.ref_income'))}}</div>
            </div>
        </div>
    </div>
</div>