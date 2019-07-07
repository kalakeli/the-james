<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title" v-if="(this.$route.params.id>0)">Edit a event</h3>
                      <h3 class="card-title" v-else>Add a new event</h3>

                      <div class="card-tools">
                        <div class="input-group input-group-sm" style="width:75px;">
                          <router-link to="/events" class="nav-link">
                            <button type="button" class="btn btn-block btn-primary" title="back to overview">
                              <i class="nav-icon fas fa-calendar-alt"></i>
                              <i class="nav-icon fas fa-calendar-alt"></i>
                            </button>
                          </router-link>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-6">
                      <form @submit.prevent="editMode ? updateEvent() : createEvent()" @keydown="form.onKeydown($event)">
                        <div class="form-group">
                          <label for="short name">Title of the Event (short) <sup class="fa-icon mandatory"></sup></label>
                          <input v-model="form.eventShort" type="eventShort" class="form-control"
                           :class="{ 'is-invalid': form.errors.has('eventShort') }"
                           id="eventShort" aria-describedby="styleHelp" placeholder="short name of the eventShort">
                          <small id="styleHelp" class="form-text text-muted">Dieser oder der vollständige Titel (nächstes Feld) wird so in der Webseite angezeigt werden</small>
                          <has-error :form="form" field="eventShort"></has-error>
                        </div>

                        <div class="form-group">
                          <label for="full name">Title of the Event (long) <sup class="fa-icon mandatory"></sup></label>
                          <input v-model="form.eventLong" type="text" class="form-control"
                           :class="{ 'is-invalid': form.errors.has('eventLong') }"
                           name="eventLong" id="eventLong" placeholder="full name of event">
                           <has-error :form="form" field="eventLong"></has-error>
                        </div>
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group">
                              <label for="full name">Link to more information</label>
                              <input v-model="form.eventLink" type="text" class="form-control"
                               :class="{ 'is-invalid': form.errors.has('eventLink') }"
                               name="eventLink" id="eventLink" placeholder="">
                               <has-error :form="form" field="eventLink"></has-error>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group">
                              <label for="full name">Linktitle</label>
                              <input v-model="form.eventLinkTitle" type="text" class="form-control"
                               :class="{ 'is-invalid': form.errors.has('eventLinkTitle') }"
                               name="eventLinkTitle" id="eventLinkTitle" placeholder="">
                               <has-error :form="form" field="eventLinkTitle"></has-error>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-3">
                            <div class="form-group">
                              <label for="color">Show online </label>
                              <input v-model="form.flagShow" type="checkbox" class="form-control"
                               :class="{ 'is-invalid': form.errors.has('flagShow') }"
                               name="flagShow" id="flagShow" style="float:left;">
                               <span style="color:green;" v-if="form.flagShow==true"> (ja)</span>
                               <span style="color:red;" v-else> (nein)</span>
                               <has-error :form="form" field="flagShow"></has-error>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                              <label for="eventType">Eventtype <sup class="fa-icon mandatory"></sup></label>
                               <select class="form-control" v-model="form.eventType"
                               :class="{ 'is-invalid': form.errors.has('eventType') }"
                               name="eventType" id="eventType" >
                                 <option value="">-- choose --</option>
                                 <option value="reading">Reading</option>
                                 <option value="st. patrick's day">St. Patrick's Day</option>
                                 <option value="football">Football Match shown</option>
                                 <option value="PubQuiz">PubQuiz</option>
                               </select>
                               <has-error :form="form" field="eventType"></has-error>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                              <label for="color">Start of Event</label>
                              <input v-model="form.eventStart" type="date" class="form-control"
                               :class="{ 'is-invalid': form.errors.has('eventStart') }"
                               name="eventStart" id="eventStart">
                               <has-error :form="form" field="eventStart"></has-error>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                              <label for="color">End of Event</label>
                              <input v-model="form.eventEnd" type="date" class="form-control"
                               :class="{ 'is-invalid': form.errors.has('eventEnd') }"
                               name="eventEnd" id="eventEnd">
                               <has-error :form="form" field="eventEnd"></has-error>
                            </div>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-6">
                            <button :disabled="form.busy" type="submit" class="btn btn-block btn-primary" v-if="(this.$route.params.id>0)">Update Event</button>
                            <button :disabled="form.busy" type="submit" class="btn btn-block btn-primary" v-else>Add to database</button>
                          </div>
                          <div class="col-6">
                            <button type="button" class="btn btn-block btn-danger" @click="form.reset()">Reset Form</button>
                          </div>
                        </div>
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
    export default {
        data () {
          return {
            editMode:false,
            // Create a new form instance
            form: new Form({
              id: '',
              eventShort: '',
              eventLong: '',
              eventLink: '',
              eventLinkTitle: '',
              eventType: '',
              eventStart: '',
              eventEnd: '',
              flagShow: ''
            })
          }
        },

        methods: {
          createEvent() {
            this.editMode=false;

            this.form.post('api/event/')
              .then(( {data} ) => {
                Toast.fire({
                  type: 'success',
                  title: 'Saved the new event successfully'
                });
                this.resetForm();
              });
          },
          updateEvent() {
            this.$Progress.start();
            this.form.put(baseUrl+'event/' + this.form.id)
              .then(( {data} ) => {
                this.$Progress.finish();
                Toast.fire({
                  type: 'success',
                  title: 'Updated the event successfully'
                });
              })
             .catch( () => {
               this.$Progress.fail();
               Toast.fire({
                 type: 'error',
                 title: 'Updating the event failed'
               });
             } );
          },
          getEvent(id) {
            this.$Progress.start();
            this.resetForm();
            axios.get(baseUrl+'event/'+id)
              .then( ( {data} ) => {
                console.log(data);
                this.form.fill(data);
              } )
            this.editMode=true;
            this.$Progress.finish();
          },
          resetForm() {
            this.form.reset();
          }
        },

        mounted() {
          // if an id is present, it is attached to the route
          if (this.$route.params.id>0) {
            this.getEvent(this.$route.params.id);
          }
        }
    }
</script>
