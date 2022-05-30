<?php echo $this->extend('layouts/frontend/app') ?>

<?php echo $this->section('breadcrumb') ?>
    <section class="breadcrumb">
        <div class="container">
            <h1 class="font-weight-bold"> Templates </h1>
            <h5 class="mb-4">Celebrate each year of their life with a customized DIY card. Design with our card maker, print, download or send online!</h5>
            <div class="breadcrumb-link">
                <!-- <a href="#">Home</a> -->
                <!-- <a href="#">Greeting</a> -->
            </div>
        </div>
    </section>
<?php echo $this->endSection() ?>

<?php echo $this->section('content') ?>
<div class="container my-5" id="template_list">
    <div class="row">
        <div class="col-md-3 filter-div">
            <div class="filter-body">
                <a class="close-filter-btn d-block d-md-none">Close</a>
                <div class="row d-none d-md-flex mb-2" style="height: 53px;" v-if="checkedNames.length > 0 || checkedTags.length > 0">
                    <div class="col-6">
                        <h5 class="font-weight-medium">Filter :</h5>
                    </div>
                    <div class="col-6 text-right">
                        <a class="cursor-pointer text-main" @click='clearCheckBox'>Clean All</a>
                    </div>
                </div>

                <div class="filter-main">
                    <h5 class="filter-title"><span>Category</span></h5>
                    <div  v-if="categeory_limit">
                        <div class="filter-div-inner">
                            <div class="filter-check-box" v-if="categeory.length > 0" v-for="(r, idx) in categeory.slice(0,10)">
																																																																																															   
                                <input class="styled-checkbox" :id="'checkbox' + r.id" name="categeory[]" type="checkbox" :value="r.slug"  @change="loadPage" :checked="r.slug == '<?php echo $categeory_id; ?>' ? 'checked':''">
                                <label :for="'checkbox' + r.id">{{ r.name }}</label>
                            </div>
                        </div>
                        <div v-if="categeory.length > 10">
                             <a class="cursor-pointer" @click="list">Show More <i class="bx bx-chevron-down"></i></a>
                        </div>
																																								 
                    </div>
                    <div class="filter-div-inner" v-else>
                        <div class="filter-check-box" v-if="categeory.length > 0" v-for="(r, idx) in categeory">
                            <input class="styled-checkbox" :id="'checkbox' + r.id" name="categeory[]" type="checkbox" :value="r.id" v-model="checkedNames" @change="loadPage">
                            <label :for="'checkbox' + r.id">{{ r.name }}</label>
                        </div>
                    </div>
																																							
                </div>
                <div class="filter-main">
                    <h5 class="filter-title"><span>Tag</span></h5>
                    <div  v-if="categeory_limit">
                        <div class="filter-div-inner">
                            <div class="filter-check-box" v-if="tag.length > 0" v-for="(r, idx) in tag.slice(0,10)">
                                <input class="styled-checkbox" :id="'tag' + r.id" name="tag[]" type="checkbox" :value="r.id" v-model="checkedTags" @change="loadPage">
                                <label :for="'tag' + r.id">{{ r.name }}</label>
                            </div>
                        </div>
                        <div v-if="categeory.length > 10">
                             <a class="cursor-pointer" @click="list">Show More <i class="bx bx-chevron-down"></i></a>
                        </div>
                    </div>
                    <div class="filter-div-inner" v-else>
                        <div class="filter-check-box" v-if="tag.length > 0" v-for="(r, idx) in tag">
                            <input class="styled-checkbox" :id="'tag' + r.id" name="tag[]" type="checkbox" :value="r.id" v-model="checkedTags" @change="loadPage">
                            <label :for="'tag' + r.id">{{ r.name }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="filter-footer d-md-none d-block">
                <div class="row m-0 w-100">
                    <div class="col p-0">
                        <a class="text-center filter-link">Apply</a>
                    </div>
                    <div class="col p-0">
                        <a class="text-center reset-link">Reset</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9 filter-result-div">
            <div class="row">
                <div class="col-md-4 d-flex justify-content-end flex-column" v-if="page_records.length > 0" v-for="(r, idx) in page_records">
                    <a :href="base_url + 'frontend/template/details/' + r.slug" class="box mb-30px">
                        <div class="box-img">
                            <img :src="'<?php echo base_url('FileReader/fetchfile/') ?>' + '/' + r.thumbnail" class="table-img">
                            <span class="tag tag-orange" v-if="r.bestceller == 'Y'">Bestseller</span>
																			
                        </div>
                        <div class="box-detail">
                            <p class="font-weight-bold mb-0">{{r.name}}</p>
                            <p class="small mb-0">{{r.description.substr(0, 100) + '...'}}</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-12 d-flex justify-content-end flex-column alert alert-danger" role="alert" v-if="page_records.length == 0">
                  <div class="col-md-12 d-flex justify-content-end flex-column">
                        <span class="text-center" colspan="8">No templates found, Try with something different.!</span>
                    </div>
                </div>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item" v-bind:class="page == 0 ? 'disabled' : ''"><a class="page-link" href="javascript:void(0)" @click="loadPrev">Previous</a></li>
                    <li class="page-item" v-bind:class="page_records.length < limit ? 'disabled' : ''" ><a class="page-link" href="javascript:void(0)" @click="loadNext">Next</a></li>
                </ul>
            </nav>
																						   
									   
																																																				
																																																																				   
					 
					  
        </div>
    </div>
</div>
<?php echo $this->endSection() ?>

<?php echo $this->section('script') ?>
<script type="text/javascript">
    var pr = new Vue({
        el: '#template_list',
        data: {
            page_records     : [],
            selected_records : [],
            categeory        : [],
            checkedNames     : [],
            temp_list        : [],
            categeory_limit  : true,
            base_url         : base_url,
            page             : 0,
            limit            : page_limit,
            next_disable     : false,
            tag              : [],
            checkedTags      : [],
            url              : '',
        },
        methods:{
            setPage:        function () {
                var o               = this.page * this.limit;
                this.page_records   = this.selected_records.slice(o, o+this.limit);
            },
            loadPrev:       function () {
                if (this.page > 0) {
                    this.page--;
                    this.loadPage();
                }
            },
            loadNext:       function () {
                if (this.page_records.length == this.limit) {
                    this.page++;
                    this.loadPage();
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
            loadPage: function () {
                var checkedCategeory = []
                $("input[name='categeory[]']:checked").each(function ()
                {
                    checkedCategeory.push($(this).val());
                });
                if (checkedCategeory == '' && this.checkedTags == '') {
                    this.url = base_url + 'frontend/template/fetch'+ '?categeory_id=' + '<?php echo $categeory_id; ?>';
                } else {
                    this.url = base_url+'frontend/template/fetch';
                }
                var data = {
                    page    : this.page + 1,
                    filter_keyword : checkedCategeory,
                    checkedTags    : this.checkedTags
                };
                data[token_name] = token_val;
                startProcess();
                $.post(this.url, data, function(response) {
                    token_val = response.token;
                    endProcess();
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
            list: function(){
                this.categeory_limit = false;
            },
            clearCheckBox: function(){
                this.checkedNames = [];
                this.checkedTags  = [];
                this.page_records = [];
                this.page_records = this.page_records.concat(this.temp_list);
            }
        },
        mounted: function() {
            startProcess();
            $.getJSON(base_url + 'frontend/template/fetch'+ '?categeory_id=' + '<?php echo $categeory_id; ?>', function () {
                
            }).done(function(response) {
                pr.page_records     = response.records;
                pr.selected_records = response.records;
                pr.categeory        = response.categeory;
                pr.tag              = response.tag;
                pr.temp_list        = response.records;
                endProcess();
            })
            .fail(function() {
                endProcess();
            })
        }
    });
</script>
<?php echo $this->endSection() ?>