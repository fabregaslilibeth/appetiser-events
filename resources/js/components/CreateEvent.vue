<template>
    <div class="container-fluid card p-4">
        <div class="row justify-content-center">
            <form @submit.prevent="submit" @click="errors.clear($event.target.name)">
                <div class="form-group">
                    <label for="name">Event</label>
                    <input v-model="event.name" type="text" class="form-control" id="name" placeholder="Event Name" name="name">
                    <small class="text-danger form-text" v-if="errors.has('name')">{{ errors.get('name')}}</small>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="dateFrom">From</label>
                        <input v-model="event.dateFrom" type="date" class="form-control" id="dateFrom" name="dateFrom">
                        <small class="text-danger form-text" v-if="errors.has('dateFrom')">{{ errors.get('dateFrom')}}</small>
                    </div>
                    <div class="form-group  col-md-6">
                        <label for="dateTo">To</label>
                        <input v-model="event.dateTo" type="date" class="form-control" id="dateTo" name="dateTo">
                        <small class="text-danger form-text" v-if="errors.has('dateTo')">{{ errors.get('dateTo')}}</small>
                    </div>
                </div>
                <div>
                    <div class="form-check form-check-inline">
                        <input v-model="days.Mon" type="checkbox" class="form-check-input" id="monday" name="includedDays">
                        <label class="form-check-label" for="monday">Mon</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input v-model="days.Tue" type="checkbox" class="form-check-input" id="tuesday" name="includedDays">
                        <label class="form-check-label" for="tuesday">Tue</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input v-model="days.Wed" type="checkbox" class="form-check-input" id="wednesday" name="includedDays">
                        <label class="form-check-label" for="wednesday">Wed</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input v-model="days.Thu" type="checkbox" class="form-check-input" id="thursday" name="includedDays">
                        <label class="form-check-label" for="thursday">Thu</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input v-model="days.Fri" type="checkbox" class="form-check-input" id="friday" name="includedDays">
                        <label class="form-check-label" for="friday">Fri</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input v-model="days.Sat" type="checkbox" class="form-check-input" id="saturday" name="includedDays">
                        <label class="form-check-label" for="saturday">Sat</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input v-model="days.Sun" type="checkbox" class="form-check-input" id="sunday" name="includedDays">
                        <label class="form-check-label" for="sunday">Sun</label>
                    </div>
                    <small class="text-danger form-text" v-if="errors.has('includedDays')">{{ errors.get('includedDays')}}</small>
                </div>
                <button type="submit" class="btn btn-primary mt-4 px-4">Save</button>
            </form>
        </div>
    </div>
</template>

<script>
import Errors from "../Errors";
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
                },
                errors: new Errors()
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
                .then(() => {
                    flash(`${this.event.name} has been added.`)
                    this.$emit('eventAdded')
                }).catch((error) => {
                    this.errors.record(error.response.data.errors)
                })
            }
        }
    }
</script>
