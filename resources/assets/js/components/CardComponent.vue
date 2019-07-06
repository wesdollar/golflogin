<template>

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <strong>Add Round</strong>
                    </div>
                    <div class="card-body">

                        <div class="row small-gutter-bottom">
                            <div class="col-md-4 offset-md-2">
                                <div class="form-group">
                                    <span class="small-gutter-bottom">
                                        Round Type
                                    </span>

                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="radio"
                                               v-model="roundType"
                                               :id="roundTypes[0]"
                                               :value="roundTypes[0]" checked>

                                        <label class="form-check-label" :for="roundTypes[0]">
                                            18 holes w/ stats
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="radio"
                                               v-model="roundType"
                                               :id="roundTypes[1]"
                                               :value="roundTypes[1]" checked>

                                        <label class="form-check-label" :for="roundTypes[1]">
                                            18 holes no stats
                                        </label>
                                    </div>
                                    <div class="form-check disabled">
                                        <input class="form-check-input"
                                               type="radio"
                                               v-model="roundType"
                                               :id="roundTypes[2]"
                                               :value="roundTypes[2]" checked>

                                        <label class="form-check-label" :for="roundTypes[2]">
                                            9 holes w/ stats
                                        </label>
                                    </div>
                                    <div class="form-check disabled">
                                        <input class="form-check-input"
                                               type="radio"
                                               v-model="roundType"
                                               :id="roundTypes[3]"
                                               :value="roundTypes[3]" checked>

                                        <label class="form-check-label" :for="roundTypes[3]">
                                            9 holes no stats
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row small-gutter-bottom" v-if="roundType === 'stats_9' || roundType === 'no_stats_9'">
                            <div class="col-md-4 offset-md-2">
                                <div class="form-group">
                                    <span class="small-gutter-bottom">
                                        Side Played
                                    </span>

                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="radio"
                                               v-model="sidePlayed"
                                               id="front_9"
                                               value="front_9" checked>

                                        <label class="form-check-label" for="front_9">
                                            Front 9
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input"
                                               type="radio"
                                               v-model="sidePlayed"
                                               id="back_9"
                                               value="back_9" checked>

                                        <label class="form-check-label" for="back_9">
                                            Back 9
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row small-gutter-bottom" v-if="meta.isOwner">
                            <div class="col-md-4 offset-md-2">
                                <div class="form-group">
                                    <label for="player">
                                        Golfer
                                    </label>
                                    <select class="form-control"
                                            name="player_id"
                                            v-model="playerId"
                                            id="player">

                                        <option v-for="player in meta.players" :value="player.id">
                                            {{ player.first_name }} {{ player.last_name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row small-gutter-bottom">
                            <div class="col-md-4 offset-md-2">
                                <div class="form-group">
                                    <label for="course-name">
                                        Course
                                    </label>
                                    <select class="form-control"
                                            name="course_id"
                                            v-model="courseId"
                                            id="course-name">

                                        <option>-- Select Course --</option>

                                        <option v-for="course in courses" :value="course.id">
                                            {{ course.title }} – {{ course.tee_box }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row small-gutter-bottom">
                            <div class="col-md-2 offset-md-2">
                                <div class="form-group">
                                    <label>
                                        Date Played
                                    </label>

                                    <datetime v-model="date" input-class="form-control" week-start="7" />

                                </div>
                            </div>
                        </div>
                        <div class="row half-gutter-bottom">
                            <div class="col-md-8 offset-md-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"
                                               v-model="tournamentRound"
                                               name="tournamenRound">
                                        Tournament Round
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div id="front-9"
                             v-if="showFront9">

                            <div class="row small-gutter-bottom">
                                <div class="col-md-2 text-right">
                                    <strong>Hole</strong>
                                </div>

                                <div class="col-md-1 center" v-for="n in 9">
                                    {{ n }}
                                </div>

                                <div class="col-md-1 center">
                                    Total
                                </div>
                            </div> <!-- // holes row -->

                            <div class="row small-gutter-bottom">
                                <div class="col-md-2 text-right">
                                    <strong>Par</strong>
                                </div>

                                <div class="col-md-1 center" v-for="n in front9ArrayMap">
                                    {{ holes[courseId][n].par }}
                                </div>
                            </div> <!-- // par row -->

                            <div class="row small-gutter-bottom">
                                <div class="col-md-2 text-right">
                                    <strong>Strokes</strong>
                                </div>

                                <div class="col-md-1 center" v-for="n in 9">
                                    <label :for="'strokes' + n" class="sr-only">Hole {{ n }} Strokes</label>
                                    <input :id="'strokes' + n"
                                           type="text"
                                           class="form-control center"
                                           v-model="strokes[n]">
                                </div>

                                <div class="col-md-1 center">
                                    {{ front9Strokes }}
                                </div>
                            </div> <!-- // strokes row -->

                            <div id="front_9_stats" v-if="roundType === 'stats_9' || roundType === 'stats_18'">

                                <div class="row small-gutter-bottom">
                                    <div class="col-md-2 text-right">
                                        <strong>Putts</strong>
                                    </div>

                                    <div class="col-md-1 center" v-for="n in 9">
                                        <label :for="'putts' + n" class="sr-only">Hole {{ n }} Putts</label>
                                        <input :id="'putts' + n"
                                               type="text"
                                               class="form-control center"
                                               v-model="putts[n]">
                                    </div>
                                </div> <!-- // putts row -->

                                <div class="row small-gutter-bottom">
                                    <div class="col-md-2 text-right">
                                        <strong>GIR</strong>
                                    </div>

                                    <div class="col-md-1 center" v-for="n in 9">

                                        <!--<span v-if="hitGreenInRegulation">Yes</span>-->
                                        <!--<span v-if="!hitGreenInRegulation">No</span>-->

                                        <label :for="'girs' + n" class="sr-only">Hole {{ n }} GIR</label>
                                        <select :id="'girs' + n"
                                                class="form-control center"
                                                v-model="girs[n]">

                                            <option value="">n/a</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>

                                        </select>
                                    </div>
                                </div> <!-- // gir row -->

                                <div class="row small-gutter-bottom">
                                    <div class="col-md-2 text-right">
                                        <strong>FIR</strong>
                                    </div>

                                    <div class="col-md-1 center" v-for="n in 9">

                                        <div v-if="holes[courseId][n].par !== 3">
                                            <label :for="'firs' + n" class="sr-only">Hole {{ n }} FIR</label>
                                            <select :id="'firs' + n"
                                                    class="form-control center"
                                                    v-model="firs[n]">

                                                <option value="">n/a</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>

                                            </select>
                                        </div>

                                    </div>
                                </div> <!-- // fir row -->

                                <div class="row small-gutter-bottom">
                                    <div class="col-md-2 text-right">
                                        <strong>Up &amp; Down</strong>
                                    </div>

                                    <div class="col-md-1 center" v-for="n in 9">
                                        <label :for="'uds' + n" class="sr-only">Hole {{ n }} Up &amp; Down</label>
                                        <select :id="'uds' + n"
                                                class="form-control center"
                                                v-model="uds[n]">

                                            <option value="">n/a</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>

                                        </select>
                                    </div>
                                </div> <!-- // up & down row -->

                                <div class="row small-gutter-bottom">
                                    <div class="col-md-2 text-right">
                                        <strong>Sand Save</strong>
                                    </div>

                                    <div class="col-md-1 center" v-for="n in 9">
                                        <label :for="'sandies' + n" class="sr-only">Hole {{ n }} Sand Save</label>
                                        <select :id="'sandies' + n"
                                                class="form-control center"
                                                v-model="sandies[n]">

                                            <option value="">n/a</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>

                                        </select>
                                    </div>
                                </div> <!-- // sandies row -->

                                <div class="row small-gutter-bottom">
                                    <div class="col-md-2 text-right">
                                        <strong>Penalty Strokes</strong>
                                    </div>

                                    <div class="col-md-1 center" v-for="n in 9">
                                        <label :for="'penalties' + n" class="sr-only">Hole {{ n }} Penalty Strokes</label>
                                        <input :id="'penalties' + n"
                                               type="text"
                                               class="form-control center"
                                               v-model="penalties[n]">
                                    </div>
                                </div> <!-- // penalties row -->

                            </div>  <!-- // front 9 stats -->

                        </div> <!-- // front nine -->

                        <div class="half-gutter-top" v-if="showVisualBreakBetweenCards">
                            &nbsp;
                        </div>

                        <div id="back-9"
                             v-if="showBack9"
                             class="half-gutter-top">
                            <div class="row small-gutter-bottom">
                                <div class="col-md-2 text-right">
                                    <strong>Hole</strong>
                                </div>

                                <div class="col-md-1 center" v-for="n in back9">
                                    {{ n }}
                                </div>
                            </div> <!-- // holes row -->

                            <div class="row small-gutter-bottom">
                                <div class="col-md-2 text-right">
                                    <strong>Par</strong>
                                </div>

                                <div class="col-md-1 center" v-for="n in back9ArrayMap">
                                    {{ holes[courseId][n].par }}
                                </div>
                            </div> <!-- // par row -->

                            <div class="row small-gutter-bottom">
                                <div class="col-md-2 text-right">
                                    <strong>Strokes</strong>
                                </div>

                                <div class="col-md-1 center" v-for="n in back9">
                                    <label :for="'strokes' + n" class="sr-only">Hole {{ n }} Strokes</label>
                                    <input :id="'strokes' + n"
                                           type="text"
                                           class="form-control center"
                                           v-model="strokes[n]">
                                </div>

                                <div class="col-md-1 center">
                                    {{ back9Strokes }}
                                </div>
                            </div> <!-- // pars row -->

                            <div id="back_9_stats" v-if="roundType === 'stats_18' || roundType === 'stats_9'">
                                <div class="row small-gutter-bottom">
                                    <div class="col-md-2 text-right">
                                        <strong>Putts</strong>
                                    </div>

                                    <div class="col-md-1 center" v-for="n in back9">
                                        <label :for="'putts' + n" class="sr-only">Hole {{ n }} Putts</label>
                                        <input :id="'putts' + n"
                                               type="text"
                                               class="form-control center"
                                               v-model="putts[n]">
                                    </div>

                                </div> <!-- // putts row -->

                                <div class="row small-gutter-bottom">
                                    <div class="col-md-2 text-right">
                                        <strong>GIR</strong>
                                    </div>

                                    <div class="col-md-1 center" v-for="n in back9">
                                        <label :for="'girs' + n" class="sr-only">Hole {{ n }} GIR</label>
                                        <select :id="'girs' + n"
                                                class="form-control center"
                                                v-model="girs[n]">

                                            <option value="">n/a</option>
                                            <option value="yes">Yes</option>
                                            <option value="No">No</option>

                                        </select>
                                    </div>
                                </div> <!-- // gir row -->

                                <div class="row small-gutter-bottom">
                                    <div class="col-md-2 text-right">
                                        <strong>FIR</strong>
                                    </div>

                                    <!-- v-if="holes[courseId][n].par !== 3" -->
                                    <div class="col-md-1 center" v-for="n in back9">

                                        <div v-if="holes[courseId][n].par !== 3">
                                            <label :for="'firs' + n" class="sr-only">Hole {{ n }} FIR</label>
                                            <select :id="'firs' + n"
                                                    class="form-control center"
                                                    v-model="firs[n]">

                                                <option value="">n/a</option>
                                                <option value="yes">Yes</option>
                                                <option value="No">No</option>

                                            </select>
                                        </div>

                                    </div>
                                </div> <!-- // fir row -->

                                <div class="row small-gutter-bottom">
                                    <div class="col-md-2 text-right">
                                        <strong>Up &amp; Down</strong>
                                    </div>

                                    <div class="col-md-1 center" v-for="n in back9">
                                        <label :for="'uds' + n" class="sr-only">Hole {{ n }} Up &amp; Down</label>
                                        <select :id="'uds' + n"
                                                class="form-control center"
                                                v-model="uds[n]">

                                            <option value="">n/a</option>
                                            <option value="yes">Yes</option>
                                            <option value="No">No</option>

                                        </select>
                                    </div>
                                </div> <!-- // up & down row -->

                                <div class="row small-gutter-bottom">
                                    <div class="col-md-2 text-right">
                                        <strong>Sand Save</strong>
                                    </div>

                                    <div class="col-md-1 center" v-for="n in back9">
                                        <label :for="'sandies' + n" class="sr-only">Hole {{ n }} Sand Save</label>
                                        <select :id="'sandies' + n"
                                                class="form-control center"
                                                v-model="sandies[n]">

                                            <option value="">n/a</option>
                                            <option value="yes">Yes</option>
                                            <option value="No">No</option>

                                        </select>
                                    </div>
                                </div> <!-- // sandies row -->

                                <div class="row small-gutter-bottom">
                                    <div class="col-md-2 text-right">
                                        <strong>Penalty Strokes</strong>
                                    </div>

                                    <div class="col-md-1 center" v-for="n in back9">
                                        <label :for="'penalties' + n" class="sr-only">Hole {{ n }} Penalty Strokes</label>
                                        <input :id="'penalties' + n"
                                               type="text"
                                               class="form-control center"
                                               v-model="penalties[n]">
                                    </div>
                                </div> <!-- // penalties row -->
                            </div> <!-- // back 9 stats -->

                        </div> <!-- // back nine -->

                        <div class="row half-gutter-top">
                            <div class="col offset-md-2">
                                <button class="btn btn-primary btn-lg" @click="postRound">
                                    Add Round
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div> <!-- // container -->

</template>

<script>
    export default {
        props: ['csrf_token', 'courses', 'holes', 'meta'],
        data () {
            return {
                back9: [10, 11, 12, 13, 14, 15, 16, 17, 18],
                front9ArrayMap: [1, 2, 3, 4, 5, 6, 7, 8, 9],
                back9ArrayMap: [10, 11, 12, 13, 14, 15, 16, 17, 18],
                // tees: [],
                putts: [],
                strokes: [],
                girs: [],
                firs: [],
                penalties: [],
                sandies: [],
                uds: [],
                tournamentRound: false,
                courseId: 0,
                playerId: 0,
                roundType: '',
                sidePlayed: '',

                roundTypes: [
                    'stats_18',
                    'no_stats_18',
                    'stats_9',
                    'no_stats_9',
                ],

                date: {
                    value: '',
                },
            };
        },

        methods: {

            nullIfUndefined(data) {
                if(typeof data === 'undefined') {

                    return null;
                }

                return data;
            },

            postRound () {
                let data = {
                    courseId: this.courseId,
                    playerId: this.playerId,
                    roundType: this.roundType,
                    tournamentRound: this.tournamentRound,
                    hole: [],
                };

                for (let i = 1; i <= 18; i++) {
                    data.hole[i] = {
                        strokes: this.nullIfUndefined(this.strokes[i]),
                        putts: this.nullIfUndefined(this.putts[i]),
                        gir: this.nullIfUndefined(this.girs[i]),
                        fir: this.nullIfUndefined(this.firs[i]),
                        up_and_down: this.nullIfUndefined(this.uds[i]),
                        sand_save: this.nullIfUndefined(this.sandies[i]),
                        penalty_strokes: this.nullIfUndefined(this.penalties[i]),
                    };
                }

                console.log(data);

                // axios.post(apiUrl, postData)
                //     .then(function (response) {
                //
                //         console.log(response);
                //
                //         // swal(
                //         //     response.data.swalTitle,
                //         //     response.data.swalBody,
                //         //     "success"
                //         // );
                //
                //     })
                //     .catch(function (error) {
                //         console.log(error);
                //     });
            }
        },

        computed: {

            hitGreenInRegulation () {
                let hole = this.holes[this.courseId][1];
                let bool = false;

                switch (hole.par) {
                    case 3:
                        if (this.strokes[hole] - this.putts[hole] === 1) {
                            bool = true;
                        }
                        break;
                    case 4:
                        if (this.strokes[hole] - this.putts[hole] === 2) {
                            bool = true;
                        }
                        break;
                    case 5:
                        if (this.strokes[hole] - this.putts[hole] === 3) {
                            bool = true;
                        }
                        break;
                }

                return bool;
            },

            showVisualBreakBetweenCards () {
                let bool = false;

                if ((this.roundType === 'stats_18' || this.roundType === 'no_stats_18') && this.courseId > 0) {
                    bool = true;
                }

                return true;
            },

            showFront9 () {
                let bool = false;

                if
                (
                    (this.roundType === 'stats_18' || this.roundType === 'no_stats_18' || this.sidePlayed === 'front_9')
                    && this.courseId > 0
                )
                {
                    return true;
                }

                return bool;
            },

            showBack9() {
                let bool = false;

                if
                (
                    (this.roundType === 'stats_18' || this.roundType === 'no_stats_18' || this.sidePlayed === 'back_9')
                    && this.courseId > 0
                )
                {
                    return true;
                }

                return bool;
            },

            front9Strokes () {
                let strokes = 0;

                if (this.strokes[1] > 0) {
                    strokes += parseInt(this.strokes[1]);
                }

                if (this.strokes[2] > 0) {
                    strokes += parseInt(this.strokes[2]);
                }

                if (this.strokes[3] > 0) {
                    strokes += parseInt(this.strokes[3]);
                }

                if (this.strokes[4] > 0) {
                    strokes += parseInt(this.strokes[4]);
                }

                if (this.strokes[5] > 0) {
                    strokes += parseInt(this.strokes[5]);
                }

                if (this.strokes[6] > 0) {
                    strokes += parseInt(this.strokes[6]);
                }

                if (this.strokes[7] > 0) {
                    strokes += parseInt(this.strokes[7]);
                }

                if (this.strokes[8] > 0) {
                    strokes += parseInt(this.strokes[8]);
                }

                if (this.strokes[9] > 0) {
                    strokes += parseInt(this.strokes[9]);
                }

                return strokes;
            },

            back9Strokes () {

                let strokes = 0;

                if (this.strokes[10] > 0) {
                    strokes += parseInt(this.strokes[10]);
                }

                if (this.strokes[11] > 0) {
                    strokes += parseInt(this.strokes[11]);
                }

                if (this.strokes[12] > 0) {
                    strokes += parseInt(this.strokes[12]);
                }

                if (this.strokes[13] > 0) {
                    strokes += parseInt(this.strokes[13]);
                }

                if (this.strokes[14] > 0) {
                    strokes += parseInt(this.strokes[14]);
                }

                if (this.strokes[15] > 0) {
                    strokes += parseInt(this.strokes[15]);
                }

                if (this.strokes[16] > 0) {
                    strokes += parseInt(this.strokes[16]);
                }

                if (this.strokes[17] > 0) {
                    strokes += parseInt(this.strokes[17]);
                }

                if (this.strokes[18] > 0) {
                    strokes += parseInt(this.strokes[18]);
                }

                return strokes;
            },
        },
        mounted () {

            // console.log(this.holes[this.courseId]);
        }
    }
</script>
