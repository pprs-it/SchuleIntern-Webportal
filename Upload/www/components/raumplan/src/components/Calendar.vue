<template>
  <div>
    <div class="calendar">
      <div class="calendar-header">
        <button class="btn btn-app chevron-left" @click="subtractWeek">
          <i class="fa fa-arrow-left"></i>Vor
        </button>
        <button @click="gotoToday"
                class="btn btn-app">
          <i class="fa fa-home"></i>Heute
        </button>
        <h3><span class="room">{{room}}</span> {{ $date(firstDayOfWeek).format("DD.") }} - {{ $date(lastDayOfWeek).format("DD. MMMM YYYY") }}</h3>
        <button class="btn btn-app chevron-right" @click="addWeek">
          <i class="fa fa-arrow-right"></i>Weiter
        </button>
      </div>


      <table class="table_1">
        <thead>
        <tr>
          <td>Stunde</td>
          <td v-bind:key="j" v-for="(day, j) in daysInWeek"
              :class="{ 'bg-orange': isToday(day) == true}">
            {{ $date(day).format('DD. dd') }}
          </td>
        </tr>
        </thead>
        <tbody class="oddEven">
        <tr v-bind:key="j" v-for="(stunde, j) in plan">
          <td>{{ j + 1 }}</td>
          <td v-bind:key="i" v-for="(day, i) in stunde">

            <span v-if="day[0]">
              <div v-bind:key="k" v-for="(unit, k) in day" class="eintrag bg-white" v-if="k != 'day'" :class="{ 'unique bg-grau-hell':  unit.state == 'unique'}" >
                <div class="margin-b-s">{{ unit.subject }}</div>
                <div class="text-right margin-b-s">{{ unit.grade }}</div>
                <div class=" text-small">{{ unit.room }}</div>
                <div class="text-right ">{{ unit.teacher }}</div>
              </div>
            </span>
            <span v-else >
              <button class="btn width-100p"
                      v-on:click.stop="openForm(j+1, day.day[0])">
                <i class="fa fa-plus"></i> Buchen
              </button>
            </span>

          </td>
        </tr>
        </tbody>
      </table>


    </div>

  </div>
</template>


<script>

export default {
  name: 'Calendar',
  props: {
    plan: Array,
    acl: Object,
    room: String
  },
  data() {
    return {

      today: this.$date(),
      thisWeek: false,

      prevDays: globals.prevDays

    }
  },
  created: function () {

    this.thisWeek = this.today;
    this.changedDate();

    this.prevDays = parseInt(this.prevDays);

    var that = this;
    EventBus.$on('calender--reload', data => {
      that.changedDate();
    });
  },
  computed: {

    firstDayOfWeek: function () {
      return this.thisWeek.startOf('week');
    },
    lastDayOfWeek: function () {
      return this.thisWeek.endOf('week');
    },
    daysInWeek: function () {
      var arr = [];
      var foo = this.firstDayOfWeek;
      for (let i = 0; i < 7; i++) {
        if (globals.showDays[foo.format('dd')] == 1) {
          arr.push([foo]);
        }
        foo = foo.add(1, 'day');
      }
      return arr;
    }

  },
  methods: {

    showBuchenBtn: function (day) {
      var prev = this.today.add(this.prevDays, 'day');
      if (prev.isBefore(day)) {
        return true;
      }
      return false;
    },
    isToday: function (day) {
      if (this.today.isSame(day, 'day')) {
        return true;
      }
      return false;
    },
    subtractWeek: function () {
      this.thisWeek = this.thisWeek.subtract(1, 'week');
      this.changedDate();
    },
    addWeek: function () {
      this.thisWeek = this.thisWeek.add(1, 'week');
      this.changedDate();
    },
    gotoToday: function () {
      this.thisWeek = this.today;
      this.changedDate();
    },
    changedDate: function () {
      EventBus.$emit('calendar--changedDate', {
        von: this.firstDayOfWeek.unix(),
        bis: this.lastDayOfWeek.unix()
      });
    },

    openForm: function (stunde, day ) {
      //console.log('openForm',room, day[0], stunde);
      EventBus.$emit('form--open', {
        item: {date: day, stunde: stunde}
      });
    },

    getEintrag: function (day) {

      if (this.plan.length <= 0) {
        return '';
      }
      var day = this.$date(day).format('YYYY-MM-DD');
      var ret = [];
      this.plan.forEach(function (item) {
        if (day == item.date) {
          ret.push(item);
        }
      });
      return ret;
    },

    openEintrag: function (item) {
      EventBus.$emit('item--open', {
        item: item
      });
    },

    orderEintrag: function (item) {
      if (!item.id) {
        return false;
      }
      EventBus.$emit('item--order', {
        item: item
      });
    }
  }
}
</script>
