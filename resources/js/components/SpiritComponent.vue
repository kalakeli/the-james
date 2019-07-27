<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title" v-if="(this.$route.params.id>0)">Edit a drink</h3>
                      <h3 class="card-title" v-else>Add a new drink</h3>

                      <div class="card-tools">
                        <div class="input-group input-group-sm" style="width:75px;">
                          <router-link to="/spirits" class="nav-link">
                            <button type="button" class="btn btn-block btn-primary" title="back to overview">
                              <i class="nav-icon fas fa-wine-glass-alt"></i>
                              <i class="nav-icon fas fa-glass-whiskey"></i>
                            </button>
                          </router-link>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-6">

                      <form @submit.prevent="editMode ? updateDrink() : createDrink()" @keydown="form.onKeydown($event)">
                        <div class="form-group">
                          <label for="short name">Type of Drink <sup class="fa-icon mandatory"></sup></label>
                             <select class="form-control" v-model="form.drinkType"
                             :class="{ 'is-invalid': form.errors.has('drinkType') }"
                             name="drinkType" id="drinkType" >
                               <option value="">-- choose --</option>
                               <option value="gin">Gin</option>
                               <option value="whiskey">Whiskey</option>
                               <option value="wine (white)">Wine (white)</option>
                               <option value="wine (red)">Wine (red)</option>
                             </select>
                             <has-error :form="form" field="drinkType"></has-error>
                        </div>

                        <!-- <div class="row">
                          <div class="col-12">
                            <h5>Type of Drink</h5>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-3">
                            <div class="form-group">
                              <div class="custom-control custom-radio">
                                <label class="custom-control-label" for="drinkType">Gin</label>
                                <input v-model="form.drinkType" type="radio" class="custom-control-input" value="Gin" id="Gin">

                              </div>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                              <div class="custom-control custom-radio">
                                <input v-model="form.drinkType" type="radio" class="custom-control-input" value="Whiskey" id="whiskey">
                                <label class="custom-control-label" for="drinkType">Whiskey</label>
                              </div>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                              <div class="custom-control custom-radio">
                                <input v-model="form.drinkType" type="radio" class="custom-control-input" value="Wine (white)" id="white_wine">
                                <label class="custom-control-label" for="drinkType">Wine (white)</label>
                              </div>
                            </div>
                          </div>
                          <div class="col-3">
                            <div class="form-group">
                              <div class="custom-control custom-radio">
                                <input v-model="form.drinkType" type="radio" class="custom-control-input" value="Wine (red)" id="red_wine">
                                <label class="custom-control-label" for="drinkType">Wine (white)</label>
                              </div>
                            </div>
                          </div>
                        </div> -->

                        <div class="form-group">
                          <label for="full name">Name of Drink <sup class="fa-icon mandatory"></sup></label>
                          <input v-model="form.drinkName" type="text" class="form-control"
                           :class="{ 'is-invalid': form.errors.has('drinkName') }"
                           name="drinkName" id="drinkName" placeholder="full name of event">
                           <has-error :form="form" field="drinkName"></has-error>
                        </div>
                        <div class="row">
                          <div class="col-6">
                            <div class="form-group">
                              <label for="full name">Description</label>
                              <input v-model="form.drinkDescription" type="text" class="form-control"
                               :class="{ 'is-invalid': form.errors.has('drinkDescription') }"
                               name="drinkDescription" id="drinkDescription" placeholder="">
                               <has-error :form="form" field="drinkDescription"></has-error>
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group">
                              <label for="country">Country</label>
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
                        </div>
                        <div class="row">
                          <div class="col-3">
                            <div class="form-group">
                              <label for="color">Show online </label>
                              <input v-model="form.flagShow" type="checkbox" class="form-control"
                               :class="{ 'is-invalid': form.errors.has('flagShow') }"
                               name="flagShow" id="flagShow" style="float:left;" :checked="form.flagShow==1">
                               <span style="color:green;" v-if="form.flagShow==true"> (ja)</span>
                               <span style="color:red;" v-else> (nein)</span>
                               <has-error :form="form" field="flagShow"></has-error>
                            </div>
                          </div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-6">
                            <button :disabled="form.busy" type="submit" class="btn btn-block btn-primary" v-if="(this.$route.params.id>0)">Update Drink</button>
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
              drinkName: '',
              drinkDescription: '',
              drinkType: '',
              country: ''
            })
          }
        },

        methods: {
          createDrink() {
            this.editMode=false;

            this.form.post('api/spirit/')
              .then(( {data} ) => {
                Toast.fire({
                  type: 'success',
                  title: 'Saved the new drink successfully'
                });
                this.resetForm();
              });
          },
          updateDrink() {
            this.$Progress.start();
            this.form.put(baseUrl+'spirit/' + this.form.id)
              .then(( {data} ) => {
                this.$Progress.finish();
                Toast.fire({
                  type: 'success',
                  title: 'Updated the drink successfully'
                });
              })
             .catch( () => {
               this.$Progress.fail();
               Toast.fire({
                 type: 'error',
                 title: 'Updating the drink failed'
               });
             } );
          },
          getDrink(id) {
            this.$Progress.start();
            this.resetForm();
            axios.get(baseUrl+'spirit/'+id)
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
            this.getDrink(this.$route.params.id);
          }
        }
    }
</script>
