<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title" v-if="(this.$route.params.id>0)">Edit a Beer Style</h3>
                      <h3 class="card-title" v-else>Add a Beer Style</h3>

                      <div class="card-tools">
                        <div class="input-group input-group-sm" style="width:75px;">
                          <router-link to="/beerstyles" class="nav-link">
                            <button type="button" class="btn btn-block btn-primary" title="back to overview">
                              <i class="nav-icon fas fa-beer"></i>
                              <i class="nav-icon fas fa-beer"></i>
                            </button>
                          </router-link>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-6">
                      <form @submit.prevent="editMode ? updateBeerStyle() : createBeerStyle()" @keydown="form.onKeydown($event)">
                        <div class="form-group">
                          <label for="Stylename">Beer Style Title</label>
                          <input v-model="form.beerStyle" type="beerStyle" class="form-control"
                           :class="{ 'is-invalid': form.errors.has('beerStyle') }"
                           id="beerStyle" aria-describedby="styleHelp" placeholder="e.g. India Pale Ale">
                          <small id="styleHelp" class="form-text text-muted">Wird so in der Webseite angezeigt werden</small>
                          <has-error :form="form" field="beerStyle"></has-error>
                        </div>

                        <div class="form-group">
                          <label for="color">Colour</label>
                          <input v-model="form.beerColor" type="text" class="form-control"
                           :class="{ 'is-invalid': form.errors.has('beerColor') }"
                           name="beerColor" id="beerColor" placeholder="e.g. gold to copper">
                           <has-error :form="form" field="beerColor"></has-error>
                        </div>
                        <div class="form-group">
                          <label for="color">Perceived Malt Aroma & Flavor</label>
                          <input v-model="form.malts" type="text" class="form-control"
                           :class="{ 'is-invalid': form.errors.has('malts') }"
                           name="malts" id="malts" placeholder="">
                           <has-error :form="form" field="malts"></has-error>
                        </div>
                        <div class="form-group">
                          <label for="color">Perceived Hop Aroma & Flavor</label>
                          <input v-model="form.hops" type="text" class="form-control"
                           :class="{ 'is-invalid': form.errors.has('hops') }"
                           name="hops" id="hops" placeholder="">
                           <has-error :form="form" field="hops"></has-error>
                        </div>
                        <div class="row">
                          <div class="col-8">
                            <div class="form-group">
                              <label for="color">Perceived Bitterness</label>
                              <input v-model="form.bitterness" type="text" class="form-control"
                               :class="{ 'is-invalid': form.errors.has('bitterness') }"
                               name="bitterness" id="bitterness" placeholder="">
                               <has-error :form="form" field="bitterness"></has-error>
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                              <label for="color">IBU (low)</label>
                              <input v-model="form.ibu_from" type="text" class="form-control"
                               :class="{ 'is-invalid': form.errors.has('ibu_from') }"
                               name="ibu_from" id="ibu_from" placeholder="lowest IBU">
                               <has-error :form="form" field="ibu_from"></has-error>
                            </div>
                          </div>
                          <div class="col-2">
                            <div class="form-group">
                              <label for="color">IBU (top)</label>
                              <input v-model="form.ibu_top" type="text" class="form-control"
                               :class="{ 'is-invalid': form.errors.has('ibu_top') }"
                               name="ibu_top" id="ibu_top" placeholder="highest IBU">
                               <has-error :form="form" field="ibu_top"></has-error>
                            </div>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-6">
                            <button :disabled="form.busy" type="submit" class="btn btn-block btn-primary" v-if="(this.$route.params.id>0)">Update BeerStyle</button>
                            <button :disabled="form.busy" type="submit" class="btn btn-block btn-primary" v-else>Add to Database</button>
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
              beerStyle: '',
              beerColor: '',
              malts: '',
              hops: '',
              bitterness: '',
              ibu_from: '',
              ibu_top: '',
              beerNotes: ''
            })
          }
        },

        methods: {
          createBeerStyle() {
            this.editMode=false;
            this.form.post("api/beerstyle")
              .then(( {data} ) => {
                Toast.fire({
                  type: 'success',
                  title: 'Saved the new beerstyle successfully'
                });
                this.resetForm();
              });
          },
          updateBeerStyle() {
            this.$Progress.start();
            this.form.put(baseUrl+'beerstyle/' + this.form.id)
              .then(( {data} ) => {
                this.$Progress.finish();
                Toast.fire({
                  type: 'success',
                  title: 'Updated the beerstyle successfully'
                });
              })
             .catch( () => {
               this.$Progress.fail();
               Toast.fire({
                 type: 'error',
                 title: 'Updating the beerstyle failed'
               });
             } );
          },
          getBeerStyle(id) {
            this.$Progress.start();
            this.resetForm();
            axios.get(baseUrl+'beerstyle/'+id)
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
            this.getBeerStyle(this.$route.params.id);
          }
        }
    }
</script>
