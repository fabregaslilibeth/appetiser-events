<template>
    <div class="container-fluid card p-4">
        <div class="row justify-content-center">
            <form @submit.prevent="submit">
                <div class="form-group">
                    <label for="eventName">Event</label>
                    <input v-model="event.name" type="text" class="form-control" id="eventName" placeholder="Event Name">
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="dateFrom">Date from</label>
                        <input v-model="event.dateFrom" type="date" class="form-control" id="dateFrom">
                    </div>
                    <div class="form-group  col-md-6">
                        <label for="dateTo">Date To</label>
                        <input v-model="event.dateTo" type="date" class="form-control" id="dateTo">
                    </div>
                </div>
                <div>
                    <div class="form-check form-check-inline">
                        <input v-model="days.Mon" type="checkbox" class="form-check-input" id="monday">
                        <label class="form-check-label" for="monday">Mon</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input v-model="days.Tue" type="checkbox" class="form-check-input" id="tuesday">
                        <label class="form-check-label" for="tuesday">Tue</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input v-model="days.Wed" type="checkbox" class="form-check-input" id="wednesday">
                        <label class="form-check-label" for="wednesday">Wed</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input v-model="days.Thu" type="checkbox" class="form-check-input" id="thursday">
                        <label class="form-check-label" for="thursday">Thu</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input v-model="days.Fri" type="checkbox" class="form-check-input" id="friday">
                        <label class="form-check-label" for="friday">Fri</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input v-model="days.Sat" type="checkbox" class="form-check-input" id="saturday">
                        <label class="form-check-label" for="saturday">Sat</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input v-model="days.Sun" type="checkbox" class="form-check-input" id="sunday">
                        <label class="form-check-label" for="sunday">Sun</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-4 px-4">Save</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'CreateEvent',
        data() {
            return {
                event: {
                    name: '',
                    dateFrom: '',
                    dateTo: '',
                    includedDays: [],
                },
                days: {
                    Mon: false,
                    Tue: false,
                    Wed: false,
                    Thu: false,
                    Fri: false,
                    Sat: false,
                    Sun: false
                }
            }
        },
        methods: {
            submit () {
                const days =  Object.entries(this.days).filter((day) => {
                    return day[1] === true && day
                });

                this.event.includedDays =  Object.entries(days).map((day) => {
                    return day[1][0]
                });

                axios.post('events', this.event)
                .then((data) => {
                    flash(`${this.event.name} has been added.`)
                    this.$emit('eventAdded', this.event.name)
                }).catch((e) => {
                    console.log(e)
                })
            }
        }

    }
</script>
