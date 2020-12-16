<style type="text/css">
	table.page_header {
		width: 100%;
		border: none;
		padding: 0mm;
		border-spacing: 0px;
		margin-top: 5px;
		margin-left: 20px;
		align-content: center;
		align-items: center;
		align-self: center;
		box-align: center;
		text-align: center;
	}

	table.page_header_garis {
		width: 100%;
		border: none;
		border-bottom: solid 1mm #77797a;
		padding: 0mm;
		border-spacing: 0px;
		margin-top: 5px;
		margin-left: 20px;
	}

	table.page_footer {
		width: 100%;
		border: none;
		padding: 0mm;
		font-size: 7px;
	}

	td.logo {
		text-align: center;
	}

	td.kop1 {
		text-align: center;
		font-size: 17px;
		width: 80%;
	}

	td.kop2 {
		text-align: center;
		font-size: 15px;
	}

	td.kop3 {
		text-align: center;
		font-size: 9px;
		line-height: 7px;
		margin-right: 100px;
	}

	td.garis {
		width: 95%;
		text-align: center;
		font-size: 9px;
		line-height: 7px;
	}

	#judul1 {
		text-align: center;
		font-size: 15px;
	}

	#judul2 {
		text-align: center;
		font-size: 13px;
	}

	#judul3 {
		text-align: left;
		font-size: 13px;
	}

	table.page {
		width: 100%;
		border: 1px;
		padding: 1mm;
		font-size: 13px;
	}

	table.detail {
		width: 100%;
		padding: 0mm;
		font-size: 13px;
		border-collapse: collapse;
		border: 1px solid black;
	}

	td.data {
		border: 1px solid black;
		font-size: 11px;
	}

	td.angka {
		border: 1px solid black;
		text-align: right;
		padding-right: 5px;
		font-size: 11px;
	}

	td.head {
		border: 1px solid black;
		font-size: 13px;
	}

	td.headangka {
		border: 1px solid black;
		text-align: right;
		padding-right: 5px;
		font-size: 13px;
	}
</style>

<page backtop="40mm" backbottom="0mm" backleft="5mm" backright="5mm">

	<page_header>
		<table class="page_header" cellspacing="0px" cellpadding="0px">
			<tr>
				<td class="logo" rowspan="10">
					<img src="<?= base_url(); ?>assets/img/logo.jpeg" alt="logo kemenkeu" width="100">
				</td>
				<td class="kop1">
					<b>KEMENTERIAN KEUANGAN REPUBLIK INDONESIA</b>
				</td>
			</tr>
			<tr>
				<td class="kop2">
					<b>DIREKTORAT JENDERAL KEKAYAAN NEGARA</b>
				</td>
			</tr>
			<tr>
				<td class="kop2" style="line-height:1px;">
					<b><?= $satker['header1']; ?></b>
				</td>
			</tr>
			<tr>
				<td class="kop2">
					<b><?= $satker['header2']; ?></b><br><br>
				</td>
			</tr>
			<tr>
				<td class="kop3">
					<?= $satker['subheader1']; ?>
				</td>
			</tr>
			<tr>
				<td class="kop3">
					<?= $satker['subheader2']; ?>
				</td>
			</tr>
			<tr>
				<td class="kop3">
					<?= $satker['subheader3']; ?>
				</td>
			</tr>
			<tr>
				<td class="kop3">
				</td>
			</tr>
			<tr>
				<td class="kop3">
				</td>
			</tr>
		</table>
		<table class="page_header_garis" cellspacing="0px" cellpadding="0px">
			<tr>
				<td class="garis"></td>
			</tr>
		</table>
	</page_header>
	<page_footer>
		<table class="page_footer">
			<tr>
				<td style="width: 100%; text-align: center">
					Alika | copyright 2017-2022 Bagian Keuangan.
				</td>
			</tr>
		</table>
	</page_footer>



</page>