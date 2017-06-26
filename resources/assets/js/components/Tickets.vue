<template>
    <div class="container">
        <div class="row" v-for="(ticket, index) in tickets" :key="ticket.id">
            <!--<ticket :tickets="tickets"></ticket>-->
            <div id="ticket">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                {{ticket.title}} created <strong>{{ticket.created_at | formatDate}}</strong>
                                by <em>{{ticket.user.name}}</em></div>

                            <div class="panel-body">
                                {{ticket.message}}
                            </div>

                            <hr>
                            <div class="col-sm-6 col-md-4">
                                <h3>Comments</h3>
                            </div>

                            <div class="panel-body" v-for="(comment, index) in ticket.comments" :key="comment.id">
                                <div id="comments">
                                    <h3>{{comment.comment}}</h3>
                                </div>
                            </div>
                            <!--<response-form></response-form>-->
                            <div class="panel-footer">
                                <form action="post" id="ticketresponsefrm">
                                    <div class="form-group">
                                        <label for="reply"
                                               style="padding-right: 5px; padding-bottom: 15px">Reply</label><span
                                            class="glyphicon glyphicon-comment"></span>
                                        <input class="form-control" type="text" id="reply">
                                    </div>

                                    <button type="submit" class="btn btn-default">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    var moment = require('moment')

    import Ticket from './Ticket.vue'
    import ResponseForm from './ResponseForm.vue'
    import collection from '../mixins/collection'

    Vue.filter('formatDate', function(value) {
        if (value) {
            return moment(String(value)).fromNow()
        }
    });

    export default {
        components: {
            Ticket, ResponseForm
        },
        mixins: [collection],
        data() {
            return {
                tickets: []
            }
        },
        created() {
            this.fetchData()
        },
        watch() {
            'fetchData'
        },
        methods: {
            fetchData() {
                axios.get('/api/tickets').then(response => {
                    this.tickets = response.data
                });
            }
        }
    }
</script>

<style>

</style>
