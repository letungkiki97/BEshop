<template>
    <div>
        <form class="form-horizontal" @submit.prevent="uploadFile">
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <span class="btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span>
                <input type="file" name="..." ref="fileInput">
                </span>
                <span class="fileinput-filename"></span>
                <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
            </div>
            <br>
            <button class="btn btn-primary">Upload and Review</button>
            <a :href="downloadurl" class="btn btn-primary">Download Template</a>
        </form>
        <h5 v-if="total">Imported : {{ completed.length }} / {{ total }}</h5>
        <table class="table sales-team import-wrapper" v-if="total">
            <thead>
                <tr>
                    <th>
                        <label class="md-check">
                            <input type="checkbox" v-model="selectedAll">
                            <i class="primary"></i>
                        </label>
                    </th>
                    <th>Name</th>
                    <th>Quotations</th>
                    <th>Opportunities</th>
                    <th>Leads</th>
                    <th>Notes</th>
                    <th>Team Leader</th>
                    <th>Team Members</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in data" :class="{'alert-info':item.created}">
                    <td>
                        <label class="md-check" v-if="!item.created">
                            <input type="checkbox" v-model="item.selected">
                            <i class="primary"></i>
                        </label>
                    </td>
                    <td>
                        <h6 style="margin: 0">{{ item.salesteam }}</h6>
                        <div>Invoice Target: {{ item.invoice_target }}</div>
                        <div>Invoice Forecast: {{ item.invoice_forecast }}</div>
                        <div class="errors alert alert-danger" v-if="item.errors">
                            <ul>
                                <li v-for="key in item.errors.response.data">
                                    {{ key }}
                                </li>
                            </ul>
                        </div>
                    </td>
                    <td>
                        <label class="md-check">
                            <input type="checkbox" v-model="item.quotations">
                            <i class="primary"></i>
                        </label>
                    </td>
                    <td>
                        <label class="md-check">
                            <input type="checkbox" v-model="item.opportunities">
                            <i class="primary"></i>
                        </label>
                    </td>
                    <td>
                        <label class="md-check">
                            <input type="checkbox" v-model="item.leads">
                            <i class="primary"></i>
                        </label>
                    </td>
                    <td>{{ item.notes }}</td>
                    <td>
                        <select class="form-control" name="team_leader" v-model="item.team_leader" style="width: 100%">
                            <option v-for="leader in staff" :value="leader.id">{{leader.text}}</option>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="team_members" v-model="item.team_members" multiple style="width: 100%">
                            <option v-for="member in staff" :value="member.id">{{member.text}}</option>
                        </select>
                    </td>
                    <td>
                        <button v-if="!item.created" class="btn btn-primary btn-xs" @click="createRecord(item)">Create</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-12">
                <a v-show="remaining.length > 0" :class="{ 'disabled': !selected.length }" href="" @click.prevent="createAll" class="btn btn-primary pull-right">Create Selected</a>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['url'],

    data: function() {
        return {
            data: [],
            staff: null,
            selectedAll: false
        }
    },

    filters: {
        success: function(items) {
            return items.filter(function(item) {
                return item.created;
            });
        },

        rejected: function(items) {
            return items.filter(function(item) {
                return item.errors
            });
        }
    },

    computed: {
        completed: function() {
            return this.data.filter(function(item) {
                return item.created;
            });
        },

        remaining: function() {
            return this.data.filter(function(item) {
                return !item.created;
            });
        },

        total: function() {
            return this.data.length;
        },

        selected: function() {
            return this.data.filter(function(item) {
                return item.selected;
            });
        },
        downloadurl: function() {
            return this.url + "download-template";
        }
    },

    methods: {
        init: function(res) {
            //Excel ROWS
            this.data = _.map(res.data.salesteams, function(item) {
                item.created = false;
                item.errors = false;
                item.selected = false;
                item.team_leader = "";
                item.team_members = [];
                return item;
            });

            //Staff to be used for Dropdown
            this.staff = res.data.staff;

            //Look for select all checkbox
            this.$watch('selectedAll', function(selected) {
                this.updateRowsSelection(selected);
            });

            this.selectedAll = false;
        },

        updateRowsSelection: function(status) {
            _.each(this.data, function(item) {
                item.selected = status;
            });
        },

        uploadFile: function() {

            var formData = new FormData();
            formData.append('file', this.$refs.fileInput.files[0]);

            axios.post(this.url + 'import', formData)
                .then(res => {
                    this.init(res.data);
                }).catch(err => {
                    alert(err.response.data);
                });
        },

        createRecord: function(item) {
            if (!item.created) {
                var vm = this;
                axios.post(this.url + 'ajax-store', item)
                    .then(function(response) {
                        item.created = true;
                        item.selected = false;
                        item.errors = null;
                    })
                    .catch(function(error) {
                        console.log(error);
                        item.errors = error;
                    });
            }
        },

        createAll: function() {
            this.selected.forEach(function(item) {
                this.createRecord(item);
            }.bind(this));
        }
    }
}
</script>
