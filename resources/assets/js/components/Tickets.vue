<template>
    <div class="container">
        <div class="row" v-for="(ticket, index) in tickets" :key="ticket.id">
            <!--<ticket :tickets="tickets"></ticket>-->
            <div id="ticket">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">{{ticket.title}}</div>

                            <div class="panel-body">
                                {{ticket.message}}
                            </div>

                            <hr>

                            <div class="panel-body">
                                <h3>Comment goes here</h3>

                                <!--<response-form></response-form>-->
                                <div class="panel-footer">
                                    <form action="post" id="ticketresponsefrm">
                                        <div class="form-group">
                                            <label for="email"><span class="glyphicon glyphicon-envelope"></span> Email</label>
                                            <input class="form-control" type="text" id="email">
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
    </div>
</template>

<script>
    import Ticket from './Ticket.vue'
    import ResponseForm from './ResponseForm.vue'
    import collection from '../mixins/collection';

    export default {
        components: {
            Ticket, ResponseForm
        },
        mixins: [collection],
        data() {
            return {tickets: []}
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
