<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title" v-if="(this.$route.params.id>0)">Edit a glossary term</h3>
                      <h3 class="card-title" v-else>Add a new term to the glossary</h3>

                      <div class="card-tools">
                        <div class="input-group input-group-sm" style="width:75px;">
                          <router-link to="/glossaries" class="nav-link">
                            <button type="button" class="btn btn-block btn-primary" title="back to overview">
                              <i class="nav-icon fas fa-book"></i>
                              <i class="nav-icon fas fa-book"></i>
                            </button>
                          </router-link>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-6">
                      <form @submit.prevent="editMode ? updateGlossaryTerm() : createGlossaryTerm()" @keydown="form.onKeydown($event)">
                        <div class="form-group">
                          <label for="short name">Term <sup class="fa-icon mandatory"></sup></label>
                          <input v-model="form.term" type="term" class="form-control"
                           :class="{ 'is-invalid': form.errors.has('term') }"
                           id="term" aria-describedby="termHelp" placeholder="e.g. fermentation">
                          <small id="termHelp" class="form-text text-muted">dies wird erklärt</small>
                          <has-error :form="form" field="term"></has-error>
                        </div>

                        <div class="form-group">
                          <label for="full name">Explanation <sup class="fa-icon mandatory"></sup></label>
                          <textarea v-model="form.explanation" type="text" class="form-control"
                           :class="{ 'is-invalid': form.errors.has('explanation') }"
                           name="explanation" id="explanation" placeholder="explain the term"></textarea>
                           <has-error :form="form" field="explanation"></has-error>
                        </div>
                        <div class="form-group">
                          <label for="address">Link to more info</label>
                          <input v-model="form.furtherInfoLink" type="text" class="form-control"
                           :class="{ 'is-invalid': form.errors.has('furtherInfoLink') }"
                           name="furtherInfoLink" id="furtherInfoLink" placeholder="in case there is a link to more information">
                           <has-error :form="form" field="furtherInfoLink"></has-error>
                        </div>
                        <div class="form-group">
                          <label for="website">Name to show for the link</label>
                          <input v-model="form.furtherInfoName" type="text" class="form-control"
                           :class="{ 'is-invalid': form.errors.has('furtherInfoName') }"
                           name="furtherInfoName" id="furtherInfoName" placeholder="e.g. link to more info">
                           <has-error :form="form" field="furtherInfoName"></has-error>
                        </div>

                          <div class="form-group">
                            <label for="color">Show online</label>
                            <input v-model="form.flagShow" type="checkbox" class="form-control"
                             :class="{ 'is-invalid': form.errors.has('flagShow') }"
                             name="flagShow" id="flagShow" >
                             <has-error :form="form" field="flagShow"></has-error>
                          </div>
                        <hr>
                        <div class="row">
                          <div class="col-6">
                            <button :disabled="form.busy" type="submit" class="btn btn-block btn-primary" v-if="(this.$route.params.id>0)">Update GlossaryTerm</button>
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
              term: '',
              explanation: '',
              furtherInfoLink: '',
              furtherInfoName: '',
              flagShow: ''
            })
          }
        },

        methods: {
          createGlossaryTerm() {
            this.editMode=false;

            this.form.post('api/glossary/')
              .then(( {data} ) => {
                Toast.fire({
                  type: 'success',
                  title: 'Saved the new term successfully'
                });
                this.resetForm();
              });
          },
          updateGlossaryTerm() {
            this.$Progress.start();
            this.form.put(baseUrl+'glossary/' + this.form.id)
              .then(( {data} ) => {
                this.$Progress.finish();
                Toast.fire({
                  type: 'success',
                  title: 'Updated the term successfully'
                });
              })
             .catch( () => {
               this.$Progress.fail();
               Toast.fire({
                 type: 'error',
                 title: 'Updating the term failed'
               });
             } );
          },
          getGlossaryTerm(id) {
            this.$Progress.start();
            this.resetForm();
            axios.get(baseUrl+'glossary/'+id)
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
            this.getGlossaryTerm(this.$route.params.id);
          }
        }
    }
</script>
