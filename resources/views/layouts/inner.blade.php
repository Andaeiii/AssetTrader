@include('sections.header')

<body>
	
	@include('sections.nav')

	@include('sections.sidebar')
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

		@include('sections.breadcrumbs')

		
			@yield('page_content')


			<div class="col-sm-12">
				<p class="back-link">&copy; {{date('Y')}} Copyright - NIIRU Swift Trade </p>
			</div>

		</div><!--/.row-->
	</div>	<!--/.main-->
	
@include('sections.footer')