jQuery(document).ready(function(a) {
    a("ul.tabs li").click(function() {
        var b = a(this).attr("data-tab");
        a("ul.tabs li").removeClass("current"), a(".tab-content").removeClass("current"), a(this).addClass("current"), a("#" + b).addClass("current")
    }), a("#search_imdb").submit(function() {
        if (a("#resultado").html('<div class="content"><span class="spinner"></span> ' + DTapi.preresultado + "</div>"), "progress" == DTapi.action) {
            var c = (a("input[name=imdbyear]").val(), a("input[name=imdbpage]").val());
            console.log(DTapi.preresultadolog), a("input[name=search_data_imdb]").prop("disabled", !0), a("input[name=search_data_imdb]").val(DTapi.loading), a.ajax({
                type: "POST",
                url: DTapi.ajaxurl + "?action=dbm_get_movies",
                data: a(this).serialize()
            }).done(function(b) {
                console.log(DTapi.resultadolog), a("input[name=imdbpage]").val(parseFloat(c) + parseFloat(1)), a("#resultado").html('<div class="content">' + b + "</div>"), a("input[name=search_data_imdb]").prop("disabled", !1), a("input[name=search_data_imdb]").val(DTapi.getcontent), a(".a_import_imdb").click(function(b) {
                    var c = a(this).data("id"),
                        d = "#" + c;
                    a("input[name=idmovie]").val(c), a("input[name=send_id_movie]").trigger("click"), a(d).hide("fast")
                }), a("#load_more_imdb_link").click(function() {
                    a("input[name=search_data_imdb]").trigger("click"), a("#filter_year_li").trigger("click")
                })
            }).fail(function(b) {
                console.log(DTapi.resultadoerror), a("#resultado").html('<div class="content">' + DTapi.resultadoerror + "</div>")
            })
        }
        return !1
    }), a("#search_all").submit(function() {
        if (a("#resultado").html('<div class="content"><span class="spinner"></span> ' + DTapi.preresultado + "</div>"), "progress" == DTapi.action) {
            var b = a("input[name=page]").val();
            a.ajax({
                type: "POST",
                url: DTapi.ajaxurl + "?action=dbm_search_all",
                data: a(this).serialize()
            }).done(function(c) {
                a("input[name=page]").val(parseFloat(b) + parseFloat(1)), a("#resultado").html('<div class="content">' + c + "</div>"), a(".a_import_imdb").click(function(b) {
                    var c = a(this).data("id"),
                        d = "#" + c;
                    a("input[name=idmovie]").val(c), a("input[name=send_id_movie]").trigger("click"), a(d).hide("fast")
                }), a(".a_import_tmdb").click(function(b) {
                    var c = a(this).data("id"),
                        d = "#" + c;
                    a("input[name=idtv]").val(c), a("input[name=send_id_tv]").trigger("click"), a(d).hide("fast")
                }), a("#load_more_search").click(function() {
                    a("button[name=search_all_data").trigger("click")
                })
            }).fail(function(b) {
                console.log(DTapi.resultadoerror), a("#resultado").html('<div class="content">' + DTapi.resultadoerror + "</div>")
            })
        }
        return !1
    }), a("#single_url_imdb").submit(function() {
        if (a("#add_data_post").html('<p><span class="spinner"></span> ' + DTapi.agregandodatos + "</p>"), "progress" == DTapi.action) {
            a("input[name=idmovie]").val();
            console.log(DTapi.agregandodatoslog), a.ajax({
                type: "POST",
                url: DTapi.ajaxurl + "?action=dbm_post_movie",
                data: a(this).serialize()
            }).done(function(b) {
                a("input[name=idmovie]").val(""), a("#add_data_post").html("<p>" + b + "</p>"), console.log(DTapi.procesocompleto)
            }).fail(function(b) {
                console.log(DTapi.postdataerror), a("#add_data_post").html("<p>" + DTapi.postdataerror + "</p>")
            })
        }
        return !1
    }), a("#search_tmdb").submit(function() {
        if (a("#resultado").html('<div class="content"><span class="spinner"></span> ' + DTapi.preresultado + "</div>"), "progress" == DTapi.action) {
            var c = (a("input[name=tmdbyear]").val(), a("input[name=tmdbpage]").val());
            console.log(DTapi.preresultadolog), a("input[name=search_data_tmdb]").prop("disabled", !0), a("input[name=search_data_tmdb]").val(DTapi.loading), a.ajax({
                type: "POST",
                url: DTapi.ajaxurl + "?action=dbm_get_tv",
                data: a(this).serialize()
            }).done(function(b) {
                a("input[name=tmdbpage]").val(parseFloat(c) + parseFloat(1)), console.log(DTapi.resultadolog), a("#resultado").html('<div class="content">' + b + "</div>"), a("input[name=search_data_tmdb]").prop("disabled", !1), a("input[name=search_data_tmdb]").val(DTapi.getcontent), a(".a_import_tmdb").click(function(b) {
                    var c = a(this).data("id"),
                        d = "#" + c;
                    a("input[name=idtv]").val(c), a("input[name=send_id_tv]").trigger("click"), a(d).hide("fast")
                }), a("#load_more_tmdb_link").click(function() {
                    a("input[name=search_data_tmdb]").trigger("click"), a("#filter_year_li").trigger("click")
                })
            }).fail(function(b) {
                console.log(DTapi.postdataerror), a("#resultado").html('<div class="content">' + DTapi.postdataerror + "</div>")
            })
        }
        return !1
    }), a("#single_url_tmdb").submit(function() {
        if (a("#add_data_post").html('<p><span class="spinner"></span> ' + DTapi.agregandodatos + "</p>"), "progress" == DTapi.action) {
            a("input[name=idtv]").val();
            console.log(DTapi.agregandodatoslog), a.ajax({
                type: "POST",
                url: DTapi.ajaxurl + "?action=dbm_post_tv",
                data: a(this).serialize()
            }).done(function(b) {
                a("input[name=idtv]").val(""), a("#add_data_post").html("<p>" + b + "</p>"), console.log(DTapi.procesocompleto)
            }).fail(function(b) {
                console.log(DTapi.postdataerror), a("#add_data_post").html("<p>" + DTapi.postdataerror + "</p>")
            })
        }
        return !1
    }), a("#api_status").submit(function() {
        return a("#add_data_post").html('<p><span class="spinner"></span> ' + DTapi.queryserver + "</p>"), "progress" == DTapi.action && (console.log(DTapi.preresultadolog), a.ajax({
            type: "POST",
            url: DTapi.ajaxurl + "?action=dbm_status",
            data: a(this).serialize()
        }).done(function(b) {
            console.log(DTapi.resultadolog), a("#add_data_post").html("<p>" + DTapi.verificationsr + "</p>"), a("#result_server").html(b), a(".skillbar").each(function() {
                a(this).find(".skillbar-bar").animate({
                    width: a(this).attr("data-percent")
                }, 500)
            })
        }).fail(function(b) {
            console.log(DTapi.postdataerror), a("#result_server").html(DTapi.postdataerror)
        })), !1
    }), a(".register_api").click(function() {
        var b = DTapi.ajaxurl,
            c = a(this).data("action");
        return a("#add_data_post").html('<p><span class="spinner"></span> ' + DTapi.loading + "</p>"), a.ajax({
            action: c,
            url: b,
            type: "post",
            data: {
                action: "register_site_db"
            },
            error: function(a) {
                console.log(a)
            },
            success: function(b) {
                a("#add_data_post").html("<p>" + DTapi.procesocompleto + "</p>"), location.reload()
            }
        }), !1
    }), a("input[name=imdbyear]").click(function() {
        a("input[name=imdbpage]").val("1")
    }), a("input[name=tmdbyear]").click(function() {
        a("input[name=tmdbpage]").val("1")
    }), a("input[name=query]").click(function() {
        a("input[name=page]").val("1")
    })
});