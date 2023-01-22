<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Dashboard Luggage</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" href="{{ asset('assets/img/icon.ico') }}" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/atlantis.min.css') }}">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/datatables.min.css"/>
</head>
<body>
    <!--   Core JS Files   -->
	<script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
	<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

	<!-- jQuery UI -->
	<script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Datatables -->
	<script src="../../assets/js/plugin/datatables/datatables.min.js"></script>

	<!-- Chart JS -->
	<script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

	<!-- jQuery Sparkline -->
	<script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

	<!-- Chart Circle -->
	<script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.13.1/b-2.3.3/b-html5-2.3.3/datatables.min.js"></script>
    
	<!-- Bootstrap Notify -->
	<script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

	<!-- Sweet Alert -->
	<script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

	<!-- Atlantis JS -->
	<script src="{{ asset('assets/js/atlantis.min.js') }}"></script>
	<div class="wrapper">

		<div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">INFO</h4>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Term & Condition</div>
                            </div>
                            <div class="card-body">
                                <p>
                                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Blanditiis maiores nihil porro ducimus, aspernatur totam repudiandae tempore esse deleniti eaque fuga alias voluptatum? Iure sit, deleniti animi consequuntur quasi repudiandae optio eaque vel ut quas praesentium unde veniam quis. Maxime dignissimos vel fugiat sit officia! Quos veniam harum molestiae et nihil nam? Alias reiciendis eum ratione minima pariatur labore repellat nisi qui impedit, reprehenderit fuga, tempore consequatur vel delectus expedita iusto. Deleniti sed obcaecati optio sunt veritatis eum dolorum sapiente consequatur necessitatibus amet, quisquam ut laborum eligendi reprehenderit recusandae nostrum nulla reiciendis nisi? Voluptate, culpa vitae blanditiis ipsa quo fuga iusto expedita nobis odio rem repellat repellendus tempore adipisci minus tempora. Nostrum officiis consectetur corrupti libero quos rem numquam sunt non itaque similique quaerat, enim eveniet possimus esse saepe, aliquid laborum aliquam reprehenderit doloremque? Ratione, distinctio et autem ex, eveniet perspiciatis laboriosam exercitationem voluptatem facere accusamus beatae? Labore culpa facilis libero iusto porro architecto corporis. Sit commodi itaque reiciendis maiores et deleniti, tenetur repudiandae distinctio sunt fugiat atque, obcaecati, quisquam officia aut cupiditate accusantium cumque quas necessitatibus repellat sint pariatur dolorum repellendus. Qui dolorum sint est ab maiores dolores cumque, molestiae temporibus natus iure nisi laudantium, repellendus corrupti! Quidem, eum dignissimos reiciendis in amet distinctio cupiditate, esse quam atque ab doloribus quo provident soluta. Sapiente beatae quisquam tempora necessitatibus quidem doloribus voluptas aperiam quibusdam rem nostrum fugiat ullam, iste dolorem, dolor pariatur veniam. Omnis excepturi quod explicabo magnam? Ullam corporis beatae repellendus illum tenetur ex? Neque minus perspiciatis excepturi ea ipsam ex animi iste maxime quod, natus temporibus dolorum consequatur numquam provident. Officia at molestias officiis atque exercitationem quam, aperiam accusamus voluptas vel repellat veniam commodi veritatis ratione. Impedit quisquam voluptates nostrum, cumque harum autem natus deleniti sint iure suscipit magnam placeat consequuntur earum doloribus tempora consectetur. Culpa sit veritatis debitis sapiente quis enim, ex maxime pariatur aperiam ea at quidem, sunt possimus eum impedit unde tenetur omnis non eius ad asperiores. Saepe fugiat neque quis commodi cupiditate! Impedit corrupti nobis ipsa, nostrum explicabo dicta est ratione doloremque sed non porro et neque. Suscipit consequatur culpa at corrupti esse recusandae. Quia, unde, repudiandae non iste eaque, ullam nesciunt soluta illum eligendi error maiores eum minus laudantium culpa assumenda atque molestiae ab quis! Magni ratione est facere nostrum dignissimos, expedita labore incidunt reprehenderit illum temporibus soluta voluptate fugit eveniet inventore eligendi hic harum id ipsa! Vero nemo quos omnis optio excepturi voluptatibus earum veritatis! Culpa ea asperiores ullam a maiores saepe libero, neque repellat corrupti distinctio vero labore consectetur, et magni enim temporibus maxime, eius dicta magnam in nesciunt. Culpa eum voluptas quam. Repudiandae cumque eum eos, expedita perspiciatis sint voluptatibus rem fugit quibusdam labore quod fugiat quisquam nobis cum. Dolorem, deleniti impedit dignissimos, ab ullam adipisci aliquid, culpa molestias repudiandae quo corrupti perferendis recusandae iusto obcaecati perspiciatis debitis eaque et harum doloremque minus quibusdam! Vitae nostrum suscipit quis debitis ducimus, ut quibusdam eligendi numquam. Doloremque error minus repellendus quod itaque doloribus recusandae labore! Inventore, voluptate odit eligendi expedita assumenda sint.
                                </p>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-end">
                                    Copyright 2022
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</body>
</html>