@unless ($breadcrumbs->isEmpty())
    <div class="brdCmb" itemscope="itemscope" itemtype="https://schema.org/BreadcrumbList">
        @foreach ($breadcrumbs as $breadcrumb)

            @if (!is_null($breadcrumb->url) && !$loop->last)
                <div class="hm" itemprop="itemListElement" itemscope="itemscope"
                itemtype="https://schema.org/ListItem">
                <a href="{{ $breadcrumb->url }}" itemprop="item"><span itemprop="name">{{ $breadcrumb->title }}</span></a>
                <meta content="1" itemprop="position">
            </div>
            @else
            <div class="lb" itemprop="itemListElement" itemscope="itemscope"
            itemtype="https://schema.org/ListItem">
                <a itemprop="item"><span itemprop="name">{{ $breadcrumb->title }}</span></a>
                <meta content="2" itemprop="position">
            </div>
            @endif

        @endforeach
    </div>
    
@endunless