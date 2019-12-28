<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Create Profile</h4>
              <p class="card-category">Complete your profile</p>
            </div>
            <div class="card-body">
              <form>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">Hospital Name</label>
                      <input
                        type="text"
                        class="form-control"
                        disabled
                        :value="auth.user.hospital_name"
                      />
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">Phone Number</label>
                      <input type="text" class="form-control" name="phone_number" required />
                    </div>

                    <span class="text-danger" v-if="error.phone_number">
                      <strong>{{ error.phone_number }}</strong>
                    </span>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="bmd-label-floating">Position in Hospital</label>
                      <input type="text" class="form-control" name="position" />
                    </div>
                  </div>

                  <span class="text-danger" v-if="error.position">
                    <strong>{{ error.position }}</strong>
                  </span>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Fist Name</label>
                      <input type="text" class="form-control" name="first_name" required />
                    </div>

                    <span class="text-danger" v-if="error.first_name">
                      <strong>{{ error.first_name }}</strong>
                    </span>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Last Name</label>
                      <input type="text" class="form-control" name="last_name" required />
                    </div>

                    <span class="text-danger" v-if="error.last_name">
                      <strong>{{ error.last_name }}</strong>
                    </span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">Address</label>
                      <input type="text" class="form-control" name="address" required />
                    </div>
                  </div>

                  <span class="text-danger" v-if="error.address">
                    <strong>{{ error.address }}</strong>
                  </span>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">City</label>
                      <input type="text" class="form-control" name="city" required />
                    </div>

                    <span class="text-danger" v-if="error.city">
                      <strong>{{ error.city }}</strong>
                    </span>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">State</label>
                      <input type="text" class="form-control" name="state" required />
                    </div>

                    <span class="text-danger" v-if="error.state">
                      <strong>{{ error.state }}</strong>
                    </span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Gender</label>
                      <!-- <select class="form-control" name="gender">
                            <option value="old('gender')">
                              @if (empty (old('gender')))
                                Choose... 
                              @else
                                {{old('gender')}}
                              @endif
                            </option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                      </select>-->
                    </div>

                    <span class="text-danger" v-if="error.gender">
                      <strong>{{ error.gender }}</strong>
                    </span>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="bmd-label-floating">Country</label>
                      <select id="country" name="country" class="form-control">
                        <!-- <option value="{{ old('country') }}">
                            @if (empty (old('country')))
                              Choose... 
                            @else
                              {{old('country')}}
                            @endif
                        </option>-->
                        <!-- @foreach ($countries as $country) -->
                        <!-- <option value="{{$country->name}}">{{$country->name}}</option> -->
                        <!-- @endforeach -->
                      </select>

                      <span class="text-danger" v-if="error.country">
                        <strong>{{ error.country }}</strong>
                      </span>
                    </div>
                  </div>
                  <br />
                </div>
                <label>Your Picture (maximum 1 mb)</label>
                <input type="file" class="btn btn-primary" name="picture" />

                <span class="text-danger" v-if="error.picture">
                  <strong>{{ error.picture }}</strong>
                </span>

                <button @click.prevent="submit" class="btn btn-primary pull-right">Create Profile</button>
                <div class="clearfix"></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapActions, mapState, mapMutations } from "vuex";
export default {
  name: "create-profile",
  data() {
    return {
      error: {}
    };
  },
  computed: {
    ...mapState(["auth"])
  },
  methods: {
    ...mapMutations(["setNotification"]),
    submit() {
      this.setNotification({ type: "success", message: "submitted" });
    }
  }
};
</script>