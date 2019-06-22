<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

              <div class="row">
                        <div class="col-12">
                          <div class="card">
                            <div class="card-header">
                              <h3 class="card-title" v-if="(this.$route.params.id>0)">Update a Beer</h3>
                              <h3 class="card-title" v-else>Add a Beer</h3>

                              <div class="card-tools">
                                <div class="input-group input-group-sm" item="width:50px;">
                                  <router-link to="/beers" class="nav-link">
                                    <button type="button" class="btn btn-block btn-primary" title="back to overview">
                                      <i class="nav-icon fas fa-beer"></i>
                                      <i class="nav-icon fas fa-beer"></i>
                                    </button>
                                  </router-link>
                                </div>
                              </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                              <div class="row">
                                <div class="col-12">
                                  <p>
                                    Nicht alle Informationen werden immer angezeigt oder sind nötig,
                                    die mit <sup class="fa-icon mandatory"></sup> sind
                                    Pflichtangaben.
                                    Aber mit ihnen seid Ihr sehr flexibel. Das Datum
                                    sollte das Datum sein, wenn Ihr wisst, dass ein
                                    Bier an den Hahn kommt. Ansonsten reicht auch die Checkbox 'soon'.
                                  </p>
                                  <p>Ich habe mich gegen einen integrierten
                                  Image-Upload entschieden, weil 90 % der Bilder bearbeitet
                                  werden müssen/sollten. Ich werde sie 'händisch' hochladen.
                                  Aber natürlich sind sie und
                                  die Credits wichtig für die Darstellung</p>
                                </div>
                              </div>
                            </div>
                            <div class="card-body">
                              <!-- beer form -->
                              <form @submit.prevent="editMode ? updateBeer() : createBeer()" @keydown="form.onKeydown($event)">
                                <div class="row">
                                  <div class="col-4">
                                    <div class="form-group">
                                      <label for="Stylename">Beer  <sup class="fa-icon mandatory"></sup></label>
                                      <input v-model="form.beer" type="beer" class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('beer') }"
                                       id="beer" aria-describedby="styleHelp" placeholder="e.g. India Pale Ale">
                                      <small id="styleHelp" class="form-text text-muted">Wird so in der Webseite angezeigt werden</small>
                                      <has-error :form="form" field="beer"></has-error>
                                    </div>
                                  </div>
                                  <div class="col-4">
                                    <div class="form-group">
                                      <label for="Stylename">Brewery <sup class="fa-icon mandatory"></sup> </label>
                                      <select v-model="form.breweryID"
                                          class="form-control"
                                         :class="{ 'is-invalid': form.errors.has('breweryID') }">
                                        <option value="">-- choose --</option>
                                        <option
                                          v-for="item in breweries"
                                          :key="item.id"
                                          :value="item.id">{{ item.breweryLong }}</option>
                                      </select>
                                      <has-error :form="form" field="breweryID"></has-error>
                                    </div>
                                  </div>
                                  <div class="col-4">
                                    <div class="form-group">
                                      <label for="Stylename">Beerstyle <sup class="fa-icon mandatory"></sup> </label>
                                      <select v-model="form.beerStyleID"
                                          class="form-control"
                                         :class="{ 'is-invalid': form.errors.has('beerStyleID') }">
                                        <option value="">-- choose --</option>
                                        <option
                                          v-for="item in beerStyles"
                                          :key="item.id"
                                          :value="item.id">{{ item.beerStyle }}</option>
                                      </select>
                                      <has-error :form="form" field="beerStyleID"></has-error>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-6">
                                    <div class="form-group">
                                      <label for="color">Colour of the beer <sup class="fa-icon mandatory"></sup></label>
                                      <input v-model="form.beerColour" type="text" class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('beerColour') }"
                                       name="beerColour" id="beerColour" aria-describedby="colourHelp" placeholder="e.g. gold to copper">
                                       <has-error :form="form" field="beerColour"></has-error>
                                       <small id="colourHelp" class="form-text text-muted">the shorter the better (max 191 chars)</small>
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                      <label for="color">Aroma of the beer <sup class="fa-icon mandatory"></sup></label>
                                      <input v-model="form.beerAroma" type="text" class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('beerAroma') }"
                                       name="beerAroma" id="beerAroma" aria-describedby="aromaHelp" placeholder="">
                                       <has-error :form="form" field="beerAroma"></has-error>
                                       <small id="aromaHelp" class="form-text text-muted">the shorter the better (max 191 chars)</small>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-6">
                                    <div class="form-group">
                                      <label for="color">Used malts <sup class="fa-icon mandatory"></sup></label>
                                      <input v-model="form.malts" type="text" class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('malts') }"
                                       name="malts" id="malts" placeholder="">
                                       <has-error :form="form" field="malts"></has-error>
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                      <label for="color">Used hops <sup class="fa-icon mandatory"></sup></label>
                                      <input v-model="form.hops" type="text" class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('hops') }"
                                       name="hops" id="hops" placeholder="">
                                       <has-error :form="form" field="hops"></has-error>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-3">
                                    <div class="form-group">
                                      <label for="color">Alcohol [%] <sup class="fa-icon mandatory"></sup></label>
                                      <input v-model="form.alcohol" type="text" class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('alcohol') }"
                                       name="alcohol" id="alcohol" aria-describedby="alcoholHelp">
                                       <has-error :form="form" field="alcohol"></has-error>
                                       <small id="alcoholHelp" class="form-text text-muted">decimal numbers with <strong class="text-danger">dot (.)</strong>! </small>
                                    </div>
                                  </div>
                                  <div class="col-3">
                                    <div class="form-group">
                                      <label for="color">Fermentation <sup class="fa-icon mandatory"></sup></label>
                                      <select v-model="form.fermentation"
                                          class="form-control"
                                         :class="{ 'is-invalid': form.errors.has('fermentation') }">
                                        <option value="">-- choose --</option>
                                        <option value="bottom">bottom</option>
                                        <option value="top">top</option>
                                      </select>
                                      <has-error :form="form" field="fermentation"></has-error>
                                    </div>
                                  </div>
                                  <div class="col-2">
                                    <div class="form-group">
                                      <label for="color">From Cask <sup class="fa-icon mandatory"></sup></label>
                                      <input v-model="form.flagCask" type="checkbox" class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('flagCask') }"
                                       name="flagCask" id="flagCask" aria-describedby="fromHelp">
                                       <has-error :form="form" field="flagCask"></has-error>
                                       <small id="fromHelp" class="form-text text-muted">one of cask, keg, bottle must be checked</small>
                                    </div>
                                  </div>
                                  <div class="col-2">
                                    <div class="form-group">
                                      <label for="color">From Keg <sup class="fa-icon mandatory"></sup></label>
                                      <input v-model="form.flagKeg" type="checkbox" class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('flagKeg') }"
                                       name="flagKeg" id="flagKeg" aria-describedby="fromHelp">
                                       <has-error :form="form" field="flagKeg"></has-error>
                                       <small id="fromHelp" class="form-text text-muted">one of cask, keg, bottle must be checked</small>
                                    </div>
                                  </div>
                                  <div class="col-2">
                                    <div class="form-group">
                                      <label for="color">From Bottle <sup class="fa-icon mandatory"></sup></label>
                                      <input v-model="form.flagBottle" type="checkbox" class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('flagBottle') }"
                                       name="flagBottle" id="flagBottle" aria-describedby="fromHelp">
                                       <has-error :form="form" field="flagBottle"></has-error>
                                       <small id="fromHelp" class="form-text text-muted">one of cask, keg, bottle must be checked</small>
                                    </div>
                                  </div>
                                </div>
                                <hr>
                                <div class="row">
                                  <div class="col-3">
                                    <div class="form-group">
                                      <label for="color">Show online</label>
                                      <input v-model="form.flagShow" type="checkbox" class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('flagShow') }"
                                       name="flagShow" id="flagShow" >
                                       <has-error :form="form" field="flagShow"></has-error>
                                    </div>
                                  </div>
                                  <div class="col-3">
                                    <div class="form-group">
                                      <label for="color">Show as available soon</label>
                                      <input v-model="form.flagSoon" type="checkbox" class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('flagSoon') }"
                                       name="flagSoon" id="flagSoon">
                                       <has-error :form="form" field="flagSoon"></has-error>
                                    </div>
                                  </div>
                                  <div class="col-3">
                                    <div class="form-group">
                                      <label for="color">Will be available from</label>
                                      <input v-model="form.availableSoon" type="date" class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('availableSoon') }"
                                       name="availableSoon" id="availableSoon" placeholder="date (YYYY-MM-DD)">
                                       <has-error :form="form" field="availableSoon"></has-error>
                                    </div>
                                  </div>
                                  <div class="col-3">
                                    <div class="form-group">
                                      <label for="color">Last cask</label>
                                      <input v-model="form.flagLastCask" type="checkbox" class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('flagLastCask') }"
                                       name="flagLastCask" id="flagLastCask" aria-describedby="lastCaskHelp" >
                                       <has-error :form="form" field="flagLastCask"></has-error>
                                       <small id="lastCaskHelp" class="form-text text-muted">mark when last cask on tap</small>
                                    </div>
                                  </div>
                                </div>
                                <hr>
                                <div class="row">
                                  <div class="col-6">
                                    <div class="form-group">
                                      <label for="color">Icon</label>
                                      <input v-model="form.iconPath" type="text" class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('iconPath') }"
                                       name="iconPath" id="iconPath" placeholder="">
                                       <has-error :form="form" field="iconPath"></has-error>
                                    </div>
                                  </div>
                                  <div class="col-6">
                                    <div class="form-group">
                                      <label for="color">Icon Credits</label>
                                      <input v-model="form.iconCredits" type="text" class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('iconCredits') }"
                                       name="iconCredits" id="iconCredits" placeholder="">
                                       <has-error :form="form" field="iconCredits"></has-error>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-12">
                                    <small>(Icons werden zu Beginn von mir bearbeitet und hochgeladen, Icons brauche ich aber von euch :-), Credits
                                      könnt Ihr natürlich schon eingeben)</small>
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
                            <!-- /.card-body -->
                          </div>
                          <!-- /.card -->
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
            beerStyles: {},
            breweries: {},
            // Create a new form instance
            form: new Form({
              id: '',
              beer: '',
              beerAroma: '',
              beerColour: '',
              brewery: '',
              breweryID: '',
              beerStyle: '',
              beerStyleID: '',
              iconPath: '',
              iconCredits: '',
              alcohol: '',
              fermentation: '',
              malts: '',
              hops: '',
              flagCask: '',
              flagKeg: '',
              flagBottle: '',
              flagLastCask: '',
              flagSoon: '',
              flagShow: '',
              availableSoon: ''
            })
          }
        },
        methods: {
          createBeer() {
            this.editMode=false;
            this.form.post("api/beer")
              .then(( {data} ) => {
                console.log(data);
                Toast.fire({
                  type: 'success',
                  title: 'Saved the new beer successfully'
                });
                this.resetForm();
              });
          },
          getBeer(id) {
            this.$Progress.start();
            this.editMode=true;
            axios.get(baseUrl+'beer/'+id)
              .then( ( {data} ) => {
                this.form.fill(data[0]);
                console.log(data);
              } )
              .catch(function (error) {
                Toast.fire({
                  type: 'error',
                  title: 'Something went wrong - the beer could not be loaded'
                });
                console.log(error);
              } )
              this.$Progress.finish();
          },
          getBeerStyles() {
            axios.get(baseUrl+'beerstyle')
              .then( (  {data} ) => {
                this.beerStyles = data.data;
              })
              .catch( () => {
                Toast.fire({
                  type: 'error',
                  title: 'Reading the Beerstyles from DB failed'
                });
              })
          },
          getBreweries() {
            axios.get(baseUrl+'brewery')
              .then( (  {data} ) => {
                this.breweries = data.data;
              })
              .catch( () => {
                Toast.fire({
                  type: 'error',
                  title: 'Reading the Breweries from DB failed'
                });
              })
          },
          resetForm() {
            this.form.reset();
          },
          updateBeer() {
            this.$Progress.start();
            this.form.put(baseUrl+'beer/' + this.$route.params.id)
              .then(( {data} ) => {
                this.$Progress.finish();
                Toast.fire({
                  type: 'success',
                  title: 'Updated the beer successfully'
                });
              })
             .catch( () => {
               this.$Progress.fail();
               Toast.fire({
                 type: 'error',
                 title: 'Updating the beer failed'
               });
             } );
          }
        },
        created() {
          this.getBreweries();
          this.getBeerStyles();
          if (this.$route.params.id>0) {
            this.getBeer(this.$route.params.id);
          }
        }
    }
</script>
