<template>
    <admin-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                    <FullCalendar :options="calendarOptions"/>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
    import AdminLayout from './../Layouts/AdminLayout'
    import FullCalendar from '@fullcalendar/vue';
    import '@fullcalendar/common/main.min.css'
    import dayGridPlugin from '@fullcalendar/daygrid';
    import fr from '@fullcalendar/core/locales/fr';
    import timeGridPlugin from '@fullcalendar/timegrid';
    import listPlugin from '@fullcalendar/list';

    export default {
        components: {
            AdminLayout,
            FullCalendar,
        },

        data () {
            return {
                calendarOptions: {
                    locale: fr,
                    plugins: [ dayGridPlugin, timeGridPlugin, listPlugin ],
                    events: this.$page.dates,
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay,list'
                    }
                },

            }
        }
    }
</script>
