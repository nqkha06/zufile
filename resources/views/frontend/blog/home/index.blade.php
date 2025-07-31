<div class="mainIn">
	<div class="secIn">

		<!--[ Blog content ]-->
		<div class="blogCont">
			<div class="blogIn">
				<!--[ Ad content ]-->
				<div class="blogAd">
					<div class="section" id="horizontal-ad">
						<div class="widget" id="HTML91">
							<div class="adB" data-text="Ads go here"></div>
						</div>
					</div>
				</div>
				<div class="blogM">
					<!--[ Main content ]-->
					<main class="blogItm mainbar">
			
						@include('fontend.blog.home.components.pinned-post')
						
						@include('fontend.blog.home.components.latest-post')
	
						<div class="section" id="add-widget">
							<div class="widget" id="HTML94">
								<div class="widget-content">
									<div class="adB" data-text="Ads go here"></div>
								</div>
							</div>
						</div>
					</main>
					<!--[ Sidebar content ]-->
					<aside class="blogItm sidebar">
						<div class="sideIn">
							<div class="section" id="side-widget">
								<div class="widget PopularPosts" id="PopularPosts00">
									<h2 class="title">Popular Posts</h2>
									<div class="itemPp" role="feed">
										@foreach ($popular_posts as $key=>$val)
										@php
										$flag = $key == 0 ? true : false;
										@endphp
										<article class="itm mostP">
											@if ($flag)
											<div class="iThmb pThmb">
												<a class="thmb" href="{{ route('blog.show', $val->slug) }}">
													<img alt="{{ $val->title }}" class="imgThm lazy" data-src="{{ $val->image }}">
													<noscript><img alt='{{ $val->title }}' class='imgThm' src='{{ $val->image }}'/></noscript>
												</a>
												@if ($val->views)
												<div class="iFxd">
													<a aria-label="Views" class="cmnt" data-text="{{ $val->views }}" role="button">
														<svg viewBox="0 0 576 512"><path d="M288 128C217.3 128 160 185.3 160 256s57.33 128 128 128c70.64 0 128-57.32 128-127.9C416 185.4 358.7 128 288 128zM288 352c-52.93 0-96-43.06-96-96s43.07-96 96-96c52.94 0 96 43.02 96 96.01C384 308.9 340.1 352 288 352zM572.5 238.1C518.3 115.5 410.9 32 288 32S57.69 115.6 3.469 238.1C1.563 243.4 0 251 0 256c0 4.977 1.562 12.6 3.469 17.03C57.72 396.5 165.1 480 288 480s230.3-83.58 284.5-206.1C574.4 268.6 576 260.1 576 256C576 251 574.4 243.4 572.5 238.1zM543.2 260.2C492.3 376 394.5 448 288 448c-106.5 0-204.3-71.98-255-187.3C32.58 259.6 32.05 256.9 31.1 256.2c.0547-1.146 .5859-3.783 .7695-4.363C83.68 135.1 181.5 64 288 64c106.5 0 204.3 71.98 255 187.3c.3945 1.08 .9238 3.713 .9785 4.443C543.9 256.9 543.4 259.6 543.2 260.2z"></path></svg>
													</a>
												</div>
												@endif
											</div>	
											@endif
											<div class="iInf pSml">
												<time class="aTtmp iTtmp pbl" data-text="{{ date('F j', strtotime($val->created_at)) }}" datetime="{{ $val->created_at }}"
													title="Published: {{ date('F j, Y', strtotime($val->created_at)) }}"></time>
												<div class="pLbls" data-text="in">
													<a aria-label="Features" data-text="{{ $val->category->name }}" href="#"
														rel="tag">
													</a>
												</div>
											</div>
											<div class="iCtnt">
												<div class="iInr">
													<h3 class="iTtl aTtl"><a href="{{ route('blog.show', $val->slug) }}">{{ $val->title }}</a></h3>
													@if ($flag)
													{{-- <div class="pSnpt">{{ $val->content }}</div> --}}
													@endif
												</div>
											</div>
										</article>

										@endforeach
									</div>
								</div>
								<div class="widget Label" id="Label00">
									<h3 class="title"> Labels </h3>
									<div class="wL pSml bg cl">
										<div class="lbSz s-2">
											<a aria-label="Disqus" class="lbN" href="https://imagz.jagodesain.com/search/label/Disqus">
												<span class="lbT">Disqus</span>
												<span class="lbC" data-text="(2)"></span>
											</a>
										</div>
										<div class="lbSz s-1">
											<a aria-label="FB" class="lbN" href="https://imagz.jagodesain.com/search/label/FB">
												<span class="lbT">FB</span>
												<span class="lbC" data-text="(1)"></span>
											</a>
										</div>
										<div class="lbSz s-5">
											<a aria-label="Features" class="lbN" href="https://imagz.jagodesain.com/search/label/Features">
												<span class="lbT">Features</span>
												<span class="lbC" data-text="(8)"></span>
											</a>
										</div>
										<div class="lbSz s-2">
											<a aria-label="Fullpage" class="lbN" href="https://imagz.jagodesain.com/search/label/Fullpage">
												<span class="lbT">Fullpage</span>
												<span class="lbC" data-text="(2)"></span>
											</a>
										</div>
										<div class="lbSz s-1">
											<a aria-label="Split" class="lbN" href="https://imagz.jagodesain.com/search/label/Split">
												<span class="lbT">Split</span>
												<span class="lbC" data-text="(1)"></span>
											</a>
										</div>
										<div class="lbSz s-1">
											<a aria-label="Tabs" class="lbN" href="https://imagz.jagodesain.com/search/label/Tabs">
												<span class="lbT">Tabs</span>
												<span class="lbC" data-text="(1)"></span>
											</a>
										</div>
									</div>
								</div>
							</div>
							<div class="sideSticky section" id="side-sticky">
								<div class="widget" id="HTML95">
									<div class="adB" data-text="Ads go here"></div>
								</div>
							</div>
						</div>
					</aside>
				</div>
			</div>
		</div>
	</div>
</div>
