<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<script src="<?= base_url()?>assets/js/highcharts/highcharts.js"></script>
<script src="<?= base_url()?>assets/js/highcharts/highcharts-more.js"></script>
<script src="<?= base_url()?>assets/js/highcharts/exporting.js"></script>
<script type="text/javascript">
	$(document).ready(function() {hiRes ();});
	var chart;
	function hiRes () {
		chart = new Highcharts.Chart({
			chart: {
				renderTo: 'chart',
				border:0,
				defaultSeriesType: 'column'
			},
			title: {
				text: ''
			},
			xAxis: {
				title: {
					text:''
				},
				categories: [
				<?php $i=0;foreach($list_jawab as $data){$i++;?>
					<?php if($data['nilai'] != "-"){echo "'$data[jawaban]',";}?>
				<?php }?>
				]
			},
			yAxis: {
				title: {
					text: 'Jumlah Populasi'
				}
			},
			legend: {
				layout: 'vertical',
				enabled:false
			},
			plotOptions: {
				series: {
					colorByPoint: true
				},
				column: {
					pointPadding: 0,
					borderWidth: 0
				}
			},
			series: [{
				shadow:1,
				border:0,
				data: [
				<?php foreach($list_jawab as $data){?>
					<?php if($data['jawaban'] != "TOTAL"){?>
						<?php if($data['nilai'] != "-"){?>
							<?= $data['nilai']?>,
						<?php }?>
					<?php }?>
					<?php }?>]
				}]
			});
	};
</script>
<!-- TODO: Pindahkan ke external css -->
<style>
	tr#total{
		background:#fffdc5;
		font-size:12px;
		white-space:nowrap;
		font-weight:bold;
	}
	h3{ margin-left: 10px; }
</style>
<!-- PAGE-HEADER -->
<div class="page-header">
	<div>
		<h1 class="page-title"><?= $indikator['pertanyaan'] ?></h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item" aria-current="page"><a href="<?= site_url(); ?>">Beranda</a>
			</li>
			<li class="breadcrumb-item active" aria-current="page"><?= $indikator['pertanyaan'] ?></li>
		</ol>
	</div>
</div>
<div class="card accordion-wizard">
	<div class="card-header">
		<h3 class="card-title"><?= $indikator['pertanyaan'] ?></h3>
	</div>
	<div class="card-body">
		<div class="middin-center" style="padding: 5px;">
			<div id="contentpane">
				<div class="ui-layout-center" id="chart" style="padding: 5px;"></div>
				<table class="table table-striped">
					<thead>
						<tr>
							<th width="1%">No</th>
							<th>Jawaban</th>
							<th width="20%" nowrap>Jumlah Responden</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($list_jawab as $data): ?>
							<tr>
								<td class="text-center"><?= $data['no']?></td>
								<td><?= $data['jawaban']?></td>
								<td class="text-center"><?= $data['nilai']?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				<div>
					<a href="<?= site_url("data_analisis?master={$indikator['id_master']}"); ?>" class="btn btn-primary">Kembali</a>
				</div>
			</div>
		</div>
	</div>
</div>

