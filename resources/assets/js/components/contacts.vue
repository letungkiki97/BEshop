<template>
    <div>
        <div v-cloak class="box1">
            <div class="row">
                <!-- column -->
                <div class="col-sm-4 col-md-3">
                    <div id="cnt-list">
                        <div class="input-group">
                            <span class="input-group-addon no-border no-bg"><i class="fa fa-search"></i></span>
                            <input type="text" class="form-control no-border no-bg" placeholder="Search All Contacts" v-model="query">
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="list" v-for="customer in full_name" :class="{'active': customer.selected }" style="cursor: pointer">
                                    <div class="list-item pointer" @click="selectItem(customer)">
                                        <div class="list-left pull-left" style="margin-right: 10px; padding-left: 8px">
                                            <span class="w-40 avatar">
                                                <img :src="customer.avatar" class="img-circle" width="40px">
                                            </span>
                                        </div>
                                        <div class="list-body">
                                            <h5 class="contact-name">{{ customer.full_name }}
                                            </h5>
                                            <small class="block text-muted">
                                                <i class="fa fa-phone"></i>
                                                {{customer.phone_number}}
                                            </small>
                                            <small class="block text-muted">
                                        <i class="fa fa-building-o"></i>
                                        {{customer.company}}
                                    </small>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /column -->
                <!-- column -->
                <div class="col-sm-6 col-md-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="cnt-list-details">
                                <div class="row" v-if="can_write">
                                    <div class="col-md-12">
                                        <a :href="createurl" class="btn btn-default">
                                            <i class="fa fa-plus fa-fw"></i> New Contact
                                        </a>
                                        <a :href="importurl" class="btn btn-default">
                                            <i class="fa fa-plus fa-fw"></i> Import Contacts
                                        </a>
                                    </div>
                                </div>
                                <div v-if="item">
                                    <div style="margin: 10px 0">
                                        <div>
                                            <a class="btn btn-sm btn-danger pull-right" @click="deleteItem(item)" v-if="can_delete">
                                                <i class="fa fa-times"></i></a>
                                            <a class="btn btn-sm btn-primary" v-if="can_write" v-show="!this.item.editing" @click="editItem(item)">Edit</a>
                                            <a class="btn btn-sm btn-primary" v-show="this.item.editing" @click="doneEditing(item)">Done</a>
                                        </div>
                                        <div class="errors alert alert-danger" v-if="errors">
                                            <ul>
                                                <!-- <li>{{ errors }}</li> -->
                                                <li v-for="key in errors">
                                                    {{ key[0] }}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div style="padding: 30px 0;">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="avatar">
                                                    <img :src="item.avatar" v-show="item.avatar" class="img-circle" width="120px">
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div v-show="!item.editing">
                                                    <h3>{{item.first_name}} {{ item.last_name }}</h3>
                                                </div>
                                                <div v-show="item.editing" class="p-l-xs">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="text" placeholder="First" class="form-control" v-model="item.first_name">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" placeholder="Last" class="form-control" v-model="item.last_name">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!-- fields -->
                                            <div class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="col-sm-3 form-control-label">Email</label>
                                                    <div class="col-sm-9">
                                                        <div class="form-group" v-show="!item.editing">{{item.email}}
                                                        </div>
                                                        <input type="text" class="form-control" v-show="item.editing" v-model="item.email">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 form-control-label">Phone</label>
                                                    <div class="col-sm-9">
                                                        <div class="form-group" v-show="!item.editing">{{item.phone_number}}
                                                        </div>
                                                        <input type="text" class="form-control" v-show="item.editing" v-model="item.phone_number">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 form-control-label">Mobile</label>
                                                    <div class="col-sm-9">
                                                        <div class="form-group" v-show="!item.editing">{{item.mobile}}
                                                        </div>
                                                        <input type="text" class="form-control" v-show="item.editing" v-model="item.mobile">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 form-control-label">Fax</label>
                                                    <div class="col-sm-9">
                                                        <div class="form-group" v-show="!item.editing">{{item.fax}}
                                                        </div>
                                                        <input type="text" class="form-control" v-show="item.editing" v-model="item.fax">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 form-control-label">Website</label>
                                                    <div class="col-sm-9">
                                                        <div class="form-group" v-show="!item.editing">
                                                            <a :href="item.website" target="_blank">{{item.website}}</a>
                                                        </div>
                                                        <input type="text" class="form-control" v-show="item.editing" v-model="item.website">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 form-control-label">Company</label>
                                                    <div class="col-sm-9">
                                                        <div class="form-group" v-show="!item.editing">{{item.company}}
                                                        </div>
                                                        <div v-if="item.editing" v-cloak>
                                                            <select class="form-control" name="sales_team_id" style="width: 100%" v-model="item.company_id">
                                                                <option v-for="company in companies" :value="company.id">{{company.text}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3  form-control-label">Sales Team</label>
                                                    <div class="col-sm-9">
                                                        <div class="form-group" v-show="!item.editing">{{item.salesteam}} - {{item.sales_team_id?item.sales_team_id:''}}
                                                        </div>
                                                        <div v-if="item.editing">
                                                            <select class="form-control" name="sales_team_id" style="width: 100%" v-model="item.sales_team_id">
                                                                <option v-for="salesTeam in salesTeams" :value="salesTeam.id">{{salesTeam.text}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3  form-control-label">Title</label>
                                                    <div class="col-sm-9">
                                                        <div class="form-group" v-show="!item.editing">{{item.title}}
                                                        </div>
                                                        <div v-if="item.editing">
                                                            <select class="form-control" name="title" style="width: 100%" v-model="item.title">
                                                                <option v-for="title in titles" :value="title.id">{{title.text}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3  form-control-label">Address</label>
                                                    <div class="col-sm-9">
                                                        <div class="form-group" v-show="!item.editing">{{item.address}}
                                                        </div>
                                                        <textarea class="form-control resize_vertical" v-show="item.editing" v-model="item.address" rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- / fields -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /column -->
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "contacts",
    props: ['url'],

    data: function() {
        return {
            customers: [],
            companies: [],
            salesTeams: [],
            titles: [],
            query: '',
            can_write: true,
            can_delete: true,
            errors: false,
            item: {}
        }
    },
    computed: {
        createurl: function() {
            return this.url + "create";
        },
        importurl: function() {
            return this.url + "import";
        },
        downloadurl: function() {
            return this.url + "download-template";
        },
        full_name: function() {
            var self = this;
            return self.customers.filter(function(item) {
                var regex = new RegExp(self.query.trim().toLowerCase());
                var res = item.full_name.toLowerCase().match(regex, "i");
                if (res != null) {
                    return item;
                }
            })
        }
    },
    methods: {
        loadContacts: function(id) {
            axios.get(this.url + 'data')
                .then(response => {
                    var customers = response.data.customers;
                    var item_index = "";
                    customers.forEach(function(item, index) {
                        item.editing = false;
                        if (item.id == id) {
                            item_index = index;
                        }
                    });
                    //to display the last user edited
                    if (item_index != "") {
                        this.item = $.extend(true, {}, customers[item_index]);
                    } else {
                        this.item = $.extend(true, {}, customers[0]);
                        this.item.selected = true;
                    }
                    this.customers = customers;
                    this.companies = response.data.companies;
                    this.salesTeams = response.data.salesTeams;
                    this.titles = response.data.titles;
                    // this.can_write=response.data.can_write;
                    // this.can_delete=response.data.can_delete);
                })
                .catch(function(error) {
                    console.log(error);
                });
        },

        updateSelection: function(status) {
            _.each(this.customers, function(item) {
                item.selected = status;
            });
        },

        deleteItem: function(item) {
            var confirm = window.confirm("Deleting customer " + item.full_name);
            if (confirm) {
                 for(var i=0;i<this.customers.length;i++){
                    if(item.id===this.customers[i].id){
                        var index=i;
                        break;
                    }
                }
                this.customers.splice(index, 1)
                this.item = $.extend(true, {}, this.customers[0]);

                axios.delete(this.url + item.id)
                    .then(function(response) {

                    })
                    .catch(function(error) {

                    });
            }
        },

        selectItem: function(item) {
            this.errors = false;

            this.updateSelection(false);
            item.selected = true;
            this.item = $.extend(true, {}, item);
        },

        editItem: function(eitem) {
            eitem.editing = true;
            this.item.editing = true;
        },

        doneEditing: function(item) {
            axios.put(this.url + item.id + '/ajax', item)
                .then(response => {
                    this.item = response.data.customers;
                    this.loadContacts(item.id);
                    this.errors = false;
                    item.editing = false;
                })
                .catch(error => {
                    this.errors = error.response.data;
                });
        }
    },

    mounted: function() {
        this.loadContacts();
        $('.scrollable').css('height', (window.innerHeight - 150));
    }
};
</script>
