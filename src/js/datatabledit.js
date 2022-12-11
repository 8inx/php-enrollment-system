/**
 * @license
 * The MIT License (MIT)
 *
 * Copyright (c) 2022 Dale Acebo.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 */

/**
 *
 * This class requires the modules
 * @class
 * @requires jquery v.3.6.1 or higher
 * @requires datatables v. 1.13.1
 * @requires jquery-tabledit
 *
 */

(function ($) {
  $.fn.Datatabledit = function (opts) {
    var self = this;
    var get = opts.get;
    var post = opts.post;
    var dataSrc = opts.dataSrc;
    var columns = opts.columns || [];
    var editable = [];
    var identifier;
    var buttons = opts.buttons || {};
    var extraButtons = opts.extraButtons || {};
    var restoreButton = opts.buttons && opts.buttons.restore ? true : false;
    var saveButton = opts.buttons && opts.buttons.save ? true : false;
    var editButton = opts.buttons && opts.buttons.edit ? true : false;
    var deleteButton = opts.buttons && opts.buttons.delete ? true : false;
    var lengthChange = opts.lengthChange;
    var ordering = opts.ordering;
    var searching = opts.searching;
    var paging = opts.paging;
    var info = opts.info;
    var onAjax = opts.onAjax || function () {};
    var onSuccess = opts.onSuccess || function () {};
    var onFail = opts.onFail || function () {};
    var onDraw = opts.onDraw || function () {};
    var rowCallback = opts.rowCallback || function () {};
    var pageLength = opts.pageLength;
    var drawCallback = opts.drawCallback || function () {};

    /**
     * Get initial src ajax
     * @returns object
     */
    var ajax = function () {
      if (opts.get) {
        return {
          url: get,
          dataSrc: dataSrc,
        };
      }
    };
    /**
     * Start Datatable
     */
    var dt = $(self).DataTable({
      ajax: ajax(),
      pageLength,
      autoWidth: false,
      lengthChange,
      ordering,
      searching,
      paging,
      info,
      columns,
      rowCallback,
      drawCallback,
    });

    for (const [key, value] of Object.entries(columns)) {
      /**
       * Get Row Identifier
       */
      if (value["identifier"] && !identifier) {
        identifier = [key, value.data];
      }
      
      //TODO:dsdasa
      /**
       * Create Editable Column
       */
      if (value.editable) {
        if (value.type === "select") {
          editable.push([key, value.data, value.options]);
        } else {
          editable.push([key, value.data]);
        }
      }
    }

    /**
     * Check if no reg buttons but have extraButtons
     */
    if (
      Object.keys(buttons).length === 0 &&
      Object.keys(extraButtons).length > 0
    ) {
      buttons["edit"] = {};
      editButton = true;
    }

    /**
     * Datatable OnDraw Callback
     */

    $(self).on("draw.dt", function () {
      /**
       * Prepare Tabledit
       */
      $(self).find(".tabledit-toolbar").parent().remove();
      /**
       * Start Of Tabledit
       */
      $(self).Tabledit({
        url: post,
        dataType: "json",
        restoreButton,
        saveButton,
        editButton,
        deleteButton,
        buttons,
        columns: {
          identifier,
          editable,
        },
        onAjax,
        onSuccess,
        onFail,
        onDraw: function () {
          dt.rows().every(function () {
            const rowId = this.data().id;
            const data = this.data();

            for (const [key, val] of Object.entries(data)) {
              const colIndex = columns.findIndex((x) => x.data === key);
              if (colIndex >= 0) {
                /**
                 * Prevent Tabledit Duplication
                 */
                const target = $(self)
                  .find("tr#" + rowId)
                  .children()
                  .eq(colIndex);
                $(target).find("span").html(val);
                $(target).css("overflow", "visible");
                /**
                 * Check Column Input Type
                 */
                for (const col of columns) {
                  if (col.editable && col.data === key) {
                    if (col.type === "checkbox") {
                      addCheckbox(target, data, col.options);
                    } else if (col.type === "time") {
                      addTime(target);
                    } else if (col.type) {
                      $(target).find("input").attr("type", col.type);
                    }

                    if (col.min) {
                      $(target).find("input").attr("min", col.min);
                    }

                    if (col.max) {
                      $(target).find("input").attr("max", col.max);
                    }

                    if (col.step) {
                      $(target).find("input").attr("step", col.step);
                    }

                    if (col.pattern) {
                      $(target).find("input").attr("patter", col.pattern);
                    }
                  }
                }
              }
            }
            /**
             * Extra Button Handler
             */

            for (const [key, val] of Object.entries(extraButtons)) {
              let btnGroup = $(self.find("tr#" + rowId)[0]).find(
                ".tabledit-toolbar .btn-group"
              );
              let style = "";
              /**
               * Extra Button: Reveal State
               */
              if (typeof val.showAt !== "undefined") {
                let isVisible = val.showAt(data);
                if (!isVisible) style = "display:none;";
              }
              /**
               * Extra Buttons: Positioning
               */

              if (val.prepend) {
                $(btnGroup).prepend(
                  '<button type="button" class="btn-extra ' +
                    val.class +
                    '" data-action="' +
                    val.action +
                    '" style="' +
                    style +
                    '">' +
                    val.html +
                    "</button>"
                );
              } else {
                $(btnGroup).append(
                  '<button type="button" class="btn-extra ' +
                    val.class +
                    '" data-action="' +
                    val.action +
                    '" style="' +
                    style +
                    '">' +
                    val.html +
                    "</button>"
                );
              }
              /**
               * extra Button: OnClick Handler
               */
              if (typeof val.onClick !== "undefined") {
                $(btnGroup)
                  .find('.btn-extra[data-action="' + val.action + '"]')
                  .each(function (i, element) {
                    $(element).click(function () {
                      data["action"] = val.action || null;
                      return val.onClick(data, val.action);
                    });
                  });
              }
            }
          });

          /**
           * Hidden Column Handler
           */
          for (const [key, val] of Object.entries(columns)) {
            // is Hidden?
            if (val.hidden) {
              $(self)
                .find("tr")
                .each(function () {
                  $(this).children().eq(key).css("display", "none");
                });
            }
          }

          /**
           * Tabledit No Data Clean Up
           */
          if (dt.rows().data().length < 1) {
            $(this).find(".tabledit-toolbar").remove();
          }
          // super draw
          onDraw();
        },
      });

      if ($(self).find("tbody tr td").hasClass("dataTables_empty")) {
        $(self).find(".tabledit-toolbar-column").hide();
        $(self).find(".tabledit-toolbar").hide();
      }
    });

    return dt;
  };
})(jQuery);

function setRendererValue(target, val) {
  $(target).find("span").html(val);
}

function addCheckbox(target, data, opts) {
  let current = data.days ? data.days.split(",") : [];
  let container = document.createElement("div");

  let checkboxes = "";
  for (const [key, val] of Object.entries(JSON.parse(opts))) {
    let isCheck = current.includes(key) ? "checked" : "";
    checkboxes +=
      '<div class="cb-col tabledit-input"><input type="checkbox" value="' +
      key +
      '" ' +
      isCheck +
      ' style="margin-right:4px"><span title="' +
      val +
      '">' +
      val +
      "</span></div>";
  }

  $(container).append("<div class='cb-wrapper'>" + checkboxes + "</div>");
  $(container).attr("data-checkbox", "checkbox");

  $(target).addClass("close-input");
  $(target).append(container);
  $(target)
    .find("input[type='checkbox']")
    .each(function () {
      $(this).change(function () {
        let parent = $(this).closest("div[data-checkbox]");
        let newVal = [];
        $(parent)
          .find('input[type="checkbox"]')
          .each(function () {
            if ($(this).is(":checked")) {
              newVal.push($(this).val());
            }
          });
        $(this).closest("td").find("input[type='text']").val(newVal.join(","));
      });
    });
}

function formatTime(time) {
  // Check correct time format and split into components
  time = time.toString().match(/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [
    time,
  ];

  if (time.length > 1) {
    time = time.slice(1);
    time.pop();
    time[5] = +time[0] < 12 ? "AM" : "PM"; // Set AM/PM
    time[0] = +time[0] % 12 || 12; // Adjust hours
  }
  return time.join("");
}

function addTime(target) {
  let input = $(target).find("input");
  setRendererValue(target, formatTime($(input).val()));
  $(input).attr("type", "time");
  $(input).change(function () {
    setRendererValue(target, formatTime($(this).val()));
  });
}
