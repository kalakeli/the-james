<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

              <div class="row">
                        <div class="col-12">
                          <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">Beers available at The James</h3>

                              <div class="card-tools">
                                <div class="input-group input-group-sm" item="width:50px;">
                                  <router-link to="/beer" class="nav-link">
                                    <button type="button" class="btn btn-block btn-primary" title="add new item">
                                      <i class="fas fa-plus-circle"></i>
                                    </button>
                                  </router-link>
                                </div>
                              </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                              <table class="table table-hover">
                                <tbody><tr>
                                  <!-- <th>ID</th> -->
                                  <th><i class="fas fa-eye" title="is the beer shown on the website?"></i></th> <!-- is it visible online? -->
                                  <th style='min-width:100px;'>Icon</th>
                                  <th>Beer</th>
                                  <th>Brewery</th>
                                  <th>BeerStyle</th>
                                  <th>IconCredits</th>

                                  <th>Alc, <br>[%]</th>
                                  <th>Fermentation</th>
                                  <th>Hops</th>
                                  <th>Malts</th>
                                  <th>Colour</th>
                                  <th>Aroma</th>
                                  <th>Cask</th>
                                  <th>Keg</th>
                                  <th>Bottle</th>

                                  <th>LastCask</th>
                                  <th>Soon</th>
                                  <th>Available (date)</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                </tr>
                                <tr v-for="item in beers" :key="item.id">
                                  <!-- <td>{{ item.id }}</td> -->
                                  <td v-if="item.flagShow===1"><span class="fa-icon yes"></span> </td>
                                  <td v-else><span class="fa-icon no"></span> </td>
                                  <td v-if="(item.iconPath!==null)">
                                    <img :src="'images/'+item.iconPath" alt="icon" class="img-circle img-fluid" >
                                  </td>
                                  <td v-else><small><em>not set</em></small></td>
                                  <td>{{ item.beer }}</td>
                                  <td>{{ item.brewery }}</td>
                                  <td>{{ item.beerStyle }}</td>

                                  <td>{{ item.iconCredits }}</td>
                                  <td>{{ item.alcohol }}</td>
                                  <td>{{ item.fermentation }}</td>
                                  <td>{{ item.hops }}</td>
                                  <td>{{ item.malts }}</td>
                                  <td>{{ item.beerColour }}</td>
                                  <td>{{ item.beerAroma }}</td>
                                  <td v-if="item.flagCask===1"><span class="fa-icon yes"></span> </td>
                                  <td v-else><span class="fa-icon no"></span> </td>
                                  <td v-if="item.flagKeg===1"><span class="fa-icon yes"></span> </td>
                                  <td v-else><span class="fa-icon no"></span> </td>
                                  <td v-if="item.flagBottle===1"><span class="fa-icon yes"></span> </td>
                                  <td v-else><span class="fa-icon no"></span> </td>

                                  <td v-if="item.flagLastCask===1"><span class="fa-icon yes"></span> </td>
                                  <td v-else><span class="fa-icon no"></span> </td>
                                  <td v-if="item.flagSoon===1"><span class="fa-icon yes"></span> </td>
                                  <td v-else><span class="fa-icon no"></span> </td>
                                  <td v-if="item.availableSoon"><small>{{ item.availableSoon }}</small> </td>
                                  <td v-else><small><em>not set</em></small> </td>

                                  <td>
                                    <router-link :to="`/beer/${item.id}`">
                                      <button type="button" class="btn btn-block btn-success" name="editBeer" title="edit item">
                                        <i class="fas fa-edit"></i>
                                      </button>
                                    </router-link>
                                  </td>
                                  <td><button type="button" class="btn btn-block btn-danger" name="deleteBeer" title="delete item" @click="deleteBeer(item.id)">
                                    <i class="fas fa-trash-alt"></i>
                                  </button> </td>
                                </tr>

                              </tbody></table>
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
        data() {
          return {
            beers: {},
            beerStyle: {},
            breweries: {}
          }
        },
        methods: {
          deleteBeer(id) {
            Swal.fire({
              title: 'Really delete this entry?',
              text: "It will be erased from the database! But you can of course re-add it :-)",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yep, let\'s delete it!'
            })
            .then((result) => {
              if (result.value) {
                axios({
                  method: 'DELETE',
                  url: './api/beer/'+id
                })
                .then( (data) => {
                  Toast.fire({
                    type: 'success',
                    title: 'Successfully deleted the item'
                  });
                  this.getBeers();
                })
                .catch( () => {
                    // handle error
                    Toast.fire({
                      type: 'error',
                      title: 'Sorry, but an error ocurred and the item could not be deleted'
                    });
                });
              }
            })
          },
          getBeers() {
            this.$Progress.start();
            axios.get('api/beer')
              .then( ( {data} ) => {
                this.beers = data; // ABFRAGE in Laravel ueber DB Raw und nicht 'normal', daher hat die Antwort einen anderen Aufbau
                console.log(data);
              } )
              .catch(function (error) {
                Toast.fire({
                  type: 'error',
                  title: 'Something went wrong - the beers could not be loaded'
                });
                console.log(error);
              } )
              this.$Progress.finish();
          },
          getBeerStyles() {
            axios.get('api/beerstyle')
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
            axios.get('api/brewery')
              .then( (  {data} ) => {
                this.breweries = data.data;
              })
              .catch( () => {
                Toast.fire({
                  type: 'error',
                  title: 'Reading the Breweries from DB failed'
                });
              })
          }
        },
        created() {
          this.getBreweries();
          this.getBeerStyles();
          this.getBeers();
        }
    }
</script>
