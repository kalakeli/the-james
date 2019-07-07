<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

              <div class="row">
                        <div class="col-12">
                          <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">Events at The James</h3>

                              <div class="card-tools">
                                <div class="input-group input-group-sm" item="width:50px;">
                                  <router-link to="/event" class="nav-link">
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
                                  <th>ID</th>
                                  <th><i class="fas fa-eye" title="is the event shown on the website?"></i></th> <!-- is it visible online? -->
                                  <th>Event (short title)</th>
                                  <th>Event (long title)</th>
                                  <th>Event-Type</th>
                                  <th>Link</th>
                                  <th>Link title</th>
                                  <th>Start</th>
                                  <th>End</th>
                                  <th>&nbsp;</th>
                                  <th>&nbsp;</th>
                                </tr>
                                <tr v-for="item in events" :key="item.id">
                                  <td>{{ item.id }}</td>
                                  <td v-if="item.flagShow==1"><span class="fa-icon yes"></span> </td>
                                  <td v-else><span class="fa-icon no"></span> </td>
                                  <td>{{ item.eventShort }}</td>
                                  <td>{{ item.eventLong }}</td>
                                  <td>{{ item.eventType }}</td>
                                  <td>{{ item.eventLink }}</td>
                                  <td>{{ item.eventLinkTitle }}</td>
                                  <td>{{ item.eventStart }}</td>
                                  <td>{{ item.eventEnd }}</td>
                                  <td>
                                    <router-link :to="`/event/${item.id}`">
                                      <button type="button" class="btn btn-block btn-success" name="editEvent" title="edit item">
                                        <i class="fas fa-edit"></i>
                                      </button>
                                    </router-link>
                                  </td>
                                  <td><button type="button" class="btn btn-block btn-danger" name="deleteEvent" title="delete item" @click="deleteEvent(item.id)">
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
            events: {}
          }
        },
        methods: {
          deleteEvent(id) {
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
                  url: './api/event/'+id
                })
                .then( (data) => {
                  Toast.fire({
                    type: 'success',
                    title: 'Successfully deleted the item'
                  });
                  this.getEvents();
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
          getEvents() {
            this.$Progress.start();
            axios.get('api/event')
              .then( ( {data} ) => {
                this.events = data.data;
                console.log(data.data);
              } )
              .catch(function (error) {
                // handle error
                console.log(error);
              } )
              this.$Progress.finish();
          }
        },
        created() {
          this.getEvents();
        }
    }
</script>
