<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title" v-if="(this.$route.params.id>0)">Edit a brewery</h3>
                      <h3 class="card-title" v-else>Add a new brewery</h3>

                      <div class="card-tools">
                        <div class="input-group input-group-sm" style="width:75px;">
                          <router-link to="/breweries" class="nav-link">
                            <button type="button" class="btn btn-block btn-primary" title="back to overview">
                              <i class="nav-icon fas fa-warehouse"></i>
                              <i class="nav-icon fas fa-warehouse"></i>
                            </button>
                          </router-link>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-6">
                      <form @submit.prevent="editMode ? updateBrewery() : createBrewery()" @keydown="form.onKeydown($event)">
                        <div class="form-group">
                          <label for="short name">Brewery</label>
                          <input v-model="form.brewery" type="brewery" class="form-control"
                           :class="{ 'is-invalid': form.errors.has('brewery') }"
                           id="brewery" aria-describedby="styleHelp" placeholder="short name of the brewery">
                          <small id="styleHelp" class="form-text text-muted">Dieser oder der vollständige Titel (nächstes Feld) wird so in der Webseite angezeigt werden</small>
                          <has-error :form="form" field="brewery"></has-error>
                        </div>

                        <div class="form-group">
                          <label for="full name">Brewery full name</label>
                          <input v-model="form.breweryLong" type="text" class="form-control"
                           :class="{ 'is-invalid': form.errors.has('breweryLong') }"
                           name="breweryLong" id="breweryLong" placeholder="full name of brewery">
                           <has-error :form="form" field="breweryLong"></has-error>
                        </div>
                        <div class="form-group">
                          <label for="address">Address</label>
                          <input v-model="form.breweryAddress" type="text" class="form-control"
                           :class="{ 'is-invalid': form.errors.has('breweryAddress') }"
                           name="breweryAddress" id="breweryAddress" placeholder="">
                           <has-error :form="form" field="breweryAddress"></has-error>
                        </div>
                        <div class="form-group">
                          <label for="website">Website</label>
                          <input v-model="form.breweryUrl" type="text" class="form-control"
                           :class="{ 'is-invalid': form.errors.has('breweryUrl') }"
                           name="breweryUrl" id="breweryUrl" placeholder="">
                           <has-error :form="form" field="breweryUrl"></has-error>
                        </div>
                        <div class="row">
                          <div class="col-2">
                            <div class="form-group">
                              <label for="country">Country</label>
                              <!-- <input v-model="form.country" type="text" class="form-control"
                               :class="{ 'is-invalid': form.errors.has('country') }"
                               name="country" id="country" placeholder=""> -->
                               <select class="form-control" v-model="form.country"
                               :class="{ 'is-invalid': form.errors.has('country') }"
                               name="country" id="country" >
                                 <option value="">-- choose --</option>
                                 <option value="Belgium">Belgium</option>
                                 <option value="Czechoslovakia">Czechoslovakia</option>
                                 <option value="England">England</option>
                                 <option value="Germany">Germany</option>
                                 <option value="Ireland">Ireland</option>
                                 <option value="Scotland">Scotland</option>
                                 <option value="USA">USA</option>
                                 <option value="Wales">Wales</option>
                               </select>
                               <has-error :form="form" field="country"></has-error>
                            </div>
                          </div>
                          <div class="col-5">
                            <div class="form-group">
                              <label for="color">Region</label>
                              <input v-model="form.region" type="text" class="form-control"
                               :class="{ 'is-invalid': form.errors.has('region') }"
                               name="region" id="region" placeholder="e.g. Yorkshire or Bavaria">
                               <has-error :form="form" field="region"></has-error>
                            </div>
                          </div>
                          <div class="col-5">
                            <div class="form-group">
                              <label for="color">Regional Touristboard Website</label>
                              <input v-model="form.regionalInformation" type="text" class="form-control"
                               :class="{ 'is-invalid': form.errors.has('regionalInformation') }"
                               name="regionalInformation" id="regionalInformation" aria-describedby="regionalInfoHelp" placeholder="website">
                               <small id="regionalInfoHelp" class="form-text text-muted">War eine Idee von Euch, Touristboard anzuzeigen; ob man es anzeigt, kann man später immer noch entscheiden</small>
                               <has-error :form="form" field="regionalInformation"></has-error>
                            </div>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-6">
                            <button :disabled="form.busy" type="submit" class="btn btn-block btn-primary" v-if="(this.$route.params.id>0)">Update Brewery</button>
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
              brewery: '',
              breweryLong: '',
              breweryAddress: '',
              breweryUrl: '',
              country: '',
              region: '',
              regionalInformation: ''
            })
          }
        },

        methods: {
          createBrewery() {
            this.editMode=false;

            this.form.post('api/brewery/')
              .then(( {data} ) => {
                Toast.fire({
                  type: 'success',
                  title: 'Saved the new brewery successfully'
                });
                this.resetForm();
              });
          },
          updateBrewery() {
            this.$Progress.start();
            this.form.put(baseUrl+'brewery/' + this.form.id)
              .then(( {data} ) => {
                this.$Progress.finish();
                Toast.fire({
                  type: 'success',
                  title: 'Updated the brewery successfully'
                });
              })
             .catch( () => {
               this.$Progress.fail();
               Toast.fire({
                 type: 'error',
                 title: 'Updating the brewery failed'
               });
             } );
          },
          getBrewery(id) {
            this.$Progress.start();
            this.resetForm();
            axios.get(baseUrl+'brewery/'+id)
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
            this.getBrewery(this.$route.params.id);
          }
        }
    }
</script>
