---
title: Webbprogrammering och Databaser

views:
    flash:
        region: flash
        template: default/image
        data:
            src: "image/tema/trad/tree2.jpg?sc=banner1&a=0,0,15,0"

    blog-list:
        region: main
        template: default/blog-list
        sort: 2
        data:
            dateFormat: j F Y
            meta: 
                type: toc-route
                route: blogg
                orderby: publishTime
                orderorder: desc

    aktuellt:
        region: sidebar-right
        template: default/block
        sort: 1
        data:
            meta:
                type: content
                route: block/home/aktuellt

    sidebar-1:
        region: sidebar-right
        template: default/block
        sort: 2
        data:
            meta:
                type: content
                route: block/home/sidebar-1

    columns-below:
        region: columns-below
        template: default/columns
        sort: 1
        data:
            class: col3
            meta:
                type: columns
                columns:
                    column-1:
                        data:
                            meta:
                                type: content
                                route: coachen/block-toc
                    column-2:
                        data:
                            meta:
                                type: content
                                route: kunskap/block-toc
                    column-3:
                        data:
                            meta:
                                type: content
                                route: uppgift/block-toc

...
Nyheter
=========================
