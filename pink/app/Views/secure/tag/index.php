<?php echo $this->extend('layouts/backend/app') ?>

<?php echo $this->section('breadcrumb') ?>
<section class="bradcr bradcr-long">
	<div class="container-fluid mw-1200">
		<div class="row">
			<div class="col-6">
				<p class="breadcrumb-head">Tag</p>
			</div>
			<div class="col-6">
				<div class="breadcrumb-cstm text-right">
					<a href="#">Secure</a>
					<a href="#" class="breadcrumb-item">Tag</a>
					<a href="#" class="breadcrumb-item">List</a>
				</div>
			</div>
		</div>
	</div>
</section>
<?php echo $this->endSection() ?>

<?php echo $this->section('content') ?>
<div class="container-fluid" id="tag">
    <div class="box">
        <div class="box-head">
            <div class="row">
                <div class="col-md-4">
                    <h1 class="box-title">Categories</h1>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" class="form-control form-control-sm" placeholder="Tag Search..." v-model="search_keyword" />
                        </div>
                        <div class="col-md-3">
                            <select class="form-control form-control-sm" v-model="status" @change="searchRecords">
                                <option value="" selected disabled hidden>Status</option>
                                <option value="ENABLE">ENABLE</option>
                                <option value="DISABLE">DISABLE</option>
                                <option value="BLOCK">BLOCK</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn w-100 btn-success btn-sm" @click="searchRecords"><i class="bx bx-search"></i></button>
                        </div>
                        <!-- <div class="col-md-1">
                            <button type="button" class="btn w-100 btn-primary btn-sm float-right"><i class="bx bxs-download" @click="loadPage(true)"></i></button>
                        </div> -->
                        <div class="col-md-1" v-if="show_reset">
                            <button type="button" class="btn w-100 btn-danger btn-sm float-right" @click="resetRecords"><i class='bx bx-x-circle'></i></button>
                        </div>
                        <div class="col-md-1">
                            <a type="button" href="<?php echo base_url('secure/tag/create') ?>" class="btn w-100 btn-info btn-sm"><i class='bx bx-plus-circle'></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
            	<?php if (session()->has('message') || session()->has('success_message')) : ?>
            	<?php
            	$class  = session()->has('success_message') ? 'success' : 'warning';
            	$msg    = session()->has('success_message') ? 'success_message' : 'message';
            	?>
            	<div class="alert alert-<?php echo $class ?> alert-dismissible fade show" role="alert">
            		<?php echo session()->getFlashdata($msg); ?>
            		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            			<span aria-hidden="true">&times;</span>
            		</button>
            	</div>
            <?php endif ?>
                <table class="table table-custom table-borderless">
                    <thead>
                        <tr class="text-left">
                            <th>S.no.</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th class="width-90">Status</th>
                            <th class="width-90">Created At</th>
                            <th class="text-right width-130">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-if="page_records.length > 0">
                        	<tr v-for="(r, idx) in page_records">
                        		<td class="">{{ idx + 1 + (page * limit) }}</td>
                        		<td class="">
                        			{{ r.name }}
                        		</td>
                        		<td class="">
                        			<span class="">{{ r.description ? r.description : '----' }}</span>
                        		</td>
                        		<td class="">
                        			<span :class="r.status == 'ENABLE' ? 'label-light-success' : 'label-light-danger'">{{ r.status }}</span>
                        		</td>
                        		<td class="">
                        			<span class="">{{ r.created_at }}</span>
                        		</td>
                        		<td class="text-right pr-0">
                        			<a :href="base_url + 'secure/tag/edit/' + r.id" class="btn btn-icon">
                        				Edit
                        			</a>
                        			<a :href="base_url + 'secure/tag/delete/' + r.id" class="btn btn-icon delete">
                        				Delete
                        			</a>
                        		</td>
                        	</tr>
                        </template>
                        <template v-else>
                        	<tr>
                        		<td class="text-center" colspan="8">No records found.!</td>
                        	</tr>
                        </template>
                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                	<ul class="pagination">
                		<li class="page-item" v-bind:class="page == 0 ? 'disabled' : ''" @click="loadPrev"><a class="page-link" href="javascript:void(0)">Previous</a></li>
                		<li class="page-item" v-bind:class="page_records.length < limit || next_disable ? 'disabled' : ''" @click="loadNext"><a class="page-link" href="javascript:void(0)">Next</a></li>
                	</ul>
                	<span class="pull-right padding-15 text-a0">Page: <strong class="text-info">{{page+1}}</strong></span>
                </nav>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection() ?>

<?php echo $this->section('script') ?>
<script type="text/javascript">
	var pr = new Vue({
		el: '#tag',
		data: {
			page_records : [],
			selected_records : [],
			all_records : [],
			search_keyword : null,
			status : '',
			base_url : base_url,
			page: 0,
			limit : page_limit,
			next_disable : false,
			show_reset : false,
		},
		watch: {
			search_keyword:        function() {
				this.search_keyword    = this.search_keyword.replace(/[^0-9a-zA-Z\s\-\.]+/g, '').substring(0, 25).trim();
			}
		},
		methods:{
			searchRecords: function () {
				this.selected_records   = [];
            	this.page               = 0;
            	this.show_reset         = true;
            	this.loadPage();
			},
			resetRecords : function () {
				this.status = '';
				this.search_keyword = '';
				this.page = 0;
				this.loadPage();
				this.show_reset = false;
			},
			setPage:        function () {
				var o               = this.page * this.limit;
				this.page_records   = this.selected_records.slice(o, o+this.limit);
			},
			loadPrev:       function () {
				if (this.page > 0) {
					this.page--;
					this.setPage();
				}
			},
			loadNext:       function () {
				if (this.page_records.length == this.limit) {
					this.page++;
					this.setPage();
					if (this.page_records.length == 0) {
						this.loadPage();
					}
				}
			},
			addRecords:     function (records) {
				this.page_records                = [];
				this.page_records                = this.page_records.concat(records);
				this.selected_records            = this.selected_records.concat(records);
			},
			loadPage:       function (csv_export = false) {
				var data = {
					page    : this.page + 1,
					status  : this.status,
					keyword : this.search_keyword
				};
				
				data[token_name] = token_val;
				if (csv_export == true) {
					data['export'] = 'Y';
					this.all_records = [];
				}else{
					this.next_disable = true;
				}
				startProcess();
				$.post(base_url+'secure/tag/fetch', data, function(response) {
					token_val = response.token;
					endProcess();
					if (csv_export == true) {
						pr.exportData(response.records);
						return;
					}
					if (response.status == 'success') {
						pr.addRecords(response.records);
					} else {
						pr.page--;
					}
					pr.next_disable = false;
				}, 'json').fail(function() {
					regenToken();
					endProcess();
					pr.page--;
					pr.next_disable = false;
				});
			},
			exportData:function(records) {
				var csvData = 'Sr No.,Tag, Status, Created At\n';
				for (var i in records) {
					var r   = records[i];
					var x   = r.name;
					x       += ','+r.slug+','+r.icon+','+r.status+',';
					x       += r.created_at+',';
					csvData += (Number(i)+1)+','+x+ '\n';
				}
				csvData = csvData.substring(0, csvData.length - 1);
				var fname = this.exportName();
				var blob = new Blob([csvData]);
				if (window.navigator.msSaveOrOpenBlob) {
					window.navigator.msSaveBlob(blob, fname);
				} else {
					var a = window.document.createElement("a");
					a.href = window.URL.createObjectURL(blob, {type: "text/plain"});
					a.download = fname;
					document.body.appendChild(a);
					a.click();
					document.body.removeChild(a);
				}
			},
			exportName:function() {
				var fname = 'Tag';
				fname += '.csv';
				return fname;
			},
			getExportDump: function () {
				
			}
		},
		mounted: function() {
			startProcess();
			$.getJSON(base_url + 'secure/tag/fetch', function () {
				
			}).done(function(response) {
				pr.page_records 	= response.records;
				pr.selected_records = response.records;
				endProcess();
			})
			.fail(function() {
				endProcess();
			})
		}
	});
</script>
<?php echo $this->endSection() ?>