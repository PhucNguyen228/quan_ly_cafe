@extends('admin.master')
@section('title')
    <div class="content-body">
        <!-- Dashboard Ecommerce Starts -->
        <section id="dashboard-ecommerce">
            <div class="row match-height">
                <!-- Medal Card -->
                <div class="col-lg-4 col-12">
                    <div class="row match-height">
                        <!-- Bar Chart - Orders -->
                        <div class="col-lg-6 col-md-3 col-6">
                            <div class="card">
                                <div class="card-body pb-50" style="position: relative;">
                                    <h6>Doanh Thu Online</h6>
                                    <h2 class="font-weight-bolder mb-1">2,76k</h2>
                                    <div id="statistics-order-chart" style="min-height: 85px;">
                                        <div id="apexchartsy0zjnq0dh"
                                            class="apexcharts-canvas apexchartsy0zjnq0dh apexcharts-theme-light"
                                            style="width: 175px; height: 70px;"><svg id="SvgjsSvg1481" width="175"
                                                height="70" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                xmlns:svgjs="http://svgjs.com/svgjs"
                                                class="apexcharts-svg apexcharts-zoomable" xmlns:data="ApexChartsNS"
                                                transform="translate(0, 0)" style="background: transparent;">
                                                <g id="SvgjsG1483" class="apexcharts-inner apexcharts-graphical"
                                                    transform="translate(14.833333333333332, 15)">
                                                    <defs id="SvgjsDefs1482">
                                                        <linearGradient id="SvgjsLinearGradient1486" x1="0"
                                                            y1="0" x2="0" y2="1">
                                                            <stop id="SvgjsStop1487" stop-opacity="0.4"
                                                                stop-color="rgba(216,227,240,0.4)" offset="0"></stop>
                                                            <stop id="SvgjsStop1488" stop-opacity="0.5"
                                                                stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                                            <stop id="SvgjsStop1489" stop-opacity="0.5"
                                                                stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                                        </linearGradient>
                                                        <clipPath id="gridRectMasky0zjnq0dh">
                                                            <rect id="SvgjsRect1491" width="179.00000000000003"
                                                                height="55" x="-12.833333333333332" y="0"
                                                                rx="0" ry="0" opacity="1"
                                                                stroke-width="0" stroke="none" stroke-dasharray="0"
                                                                fill="#fff"></rect>
                                                        </clipPath>
                                                        <clipPath id="gridRectMarkerMasky0zjnq0dh">
                                                            <rect id="SvgjsRect1492" width="157.33333333333334"
                                                                height="59" x="-2" y="-2" rx="0"
                                                                ry="0" opacity="1" stroke-width="0"
                                                                stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                    </defs>
                                                    <rect id="SvgjsRect1490" width="7.666666666666668" height="55"
                                                        x="0" y="0" rx="0" ry="0"
                                                        opacity="1" stroke-width="0" stroke-dasharray="3"
                                                        fill="url(#SvgjsLinearGradient1486)" class="apexcharts-xcrosshairs"
                                                        y2="55" filter="none" fill-opacity="0.9"></rect>
                                                    <g id="SvgjsG1506" class="apexcharts-xaxis" transform="translate(0, 0)">
                                                        <g id="SvgjsG1507" class="apexcharts-xaxis-texts-g"
                                                            transform="translate(0, -4)"></g>
                                                    </g>
                                                    <g id="SvgjsG1509" class="apexcharts-grid">
                                                        <g id="SvgjsG1510" class="apexcharts-gridlines-horizontal"
                                                            style="display: none;">
                                                            <line id="SvgjsLine1512" x1="-10.833333333333332"
                                                                y1="0" x2="164.16666666666669" y2="0"
                                                                stroke="#e0e0e0" stroke-dasharray="0"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1513" x1="-10.833333333333332"
                                                                y1="11" x2="164.16666666666669" y2="11"
                                                                stroke="#e0e0e0" stroke-dasharray="0"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1514" x1="-10.833333333333332"
                                                                y1="22" x2="164.16666666666669" y2="22"
                                                                stroke="#e0e0e0" stroke-dasharray="0"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1515" x1="-10.833333333333332"
                                                                y1="33" x2="164.16666666666669" y2="33"
                                                                stroke="#e0e0e0" stroke-dasharray="0"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1516" x1="-10.833333333333332"
                                                                y1="44" x2="164.16666666666669" y2="44"
                                                                stroke="#e0e0e0" stroke-dasharray="0"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1517" x1="-10.833333333333332"
                                                                y1="55" x2="164.16666666666669" y2="55"
                                                                stroke="#e0e0e0" stroke-dasharray="0"
                                                                class="apexcharts-gridline"></line>
                                                        </g>
                                                        <g id="SvgjsG1511" class="apexcharts-gridlines-vertical"
                                                            style="display: none;"></g>
                                                        <line id="SvgjsLine1519" x1="0" y1="55"
                                                            x2="153.33333333333334" y2="55" stroke="transparent"
                                                            stroke-dasharray="0"></line>
                                                        <line id="SvgjsLine1518" x1="0" y1="1"
                                                            x2="0" y2="55" stroke="transparent"
                                                            stroke-dasharray="0"></line>
                                                    </g>
                                                    <g id="SvgjsG1493"
                                                        class="apexcharts-bar-series apexcharts-plot-series">
                                                        <g id="SvgjsG1494" class="apexcharts-series" seriesName="2020"
                                                            rel="1" data:realIndex="0">
                                                            <rect id="SvgjsRect1496" width="7.666666666666668"
                                                                height="55" x="-3.833333333333334" y="0"
                                                                rx="5" ry="5" opacity="1"
                                                                stroke-width="0" stroke="none" stroke-dasharray="0"
                                                                fill="#f3f3f3" class="apexcharts-backgroundBar"></rect>
                                                            <path id="SvgjsPath1497"
                                                                d="M -3.833333333333334 53.083333333333336L -3.833333333333334 30.25L 3.833333333333334 30.25L 3.833333333333334 30.25L 3.833333333333334 53.083333333333336Q 0 56.91666666666667 -3.833333333333334 53.083333333333336z"
                                                                fill="rgba(255,159,67,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="square"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="0"
                                                                clip-path="url(#gridRectMasky0zjnq0dh)"
                                                                pathTo="M -3.833333333333334 53.083333333333336L -3.833333333333334 30.25L 3.833333333333334 30.25L 3.833333333333334 30.25L 3.833333333333334 53.083333333333336Q 0 56.91666666666667 -3.833333333333334 53.083333333333336z"
                                                                pathFrom="M -3.833333333333334 53.083333333333336L -3.833333333333334 55L 3.833333333333334 55L 3.833333333333334 55L 3.833333333333334 55L -3.833333333333334 55"
                                                                cy="30.25" cx="3.833333333333332" j="0"
                                                                val="45" barHeight="24.75"
                                                                barWidth="7.666666666666668"></path>
                                                            <rect id="SvgjsRect1498" width="7.666666666666668"
                                                                height="55" x="34.5" y="0"
                                                                rx="5" ry="5" opacity="1"
                                                                stroke-width="0" stroke="none" stroke-dasharray="0"
                                                                fill="#f3f3f3" class="apexcharts-backgroundBar"></rect>
                                                            <path id="SvgjsPath1499"
                                                                d="M 34.5 53.083333333333336L 34.5 8.25L 42.16666666666667 8.25L 42.16666666666667 8.25L 42.16666666666667 53.083333333333336Q 38.333333333333336 56.91666666666667 34.5 53.083333333333336z"
                                                                fill="rgba(255,159,67,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="square"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="0"
                                                                clip-path="url(#gridRectMasky0zjnq0dh)"
                                                                pathTo="M 34.5 53.083333333333336L 34.5 8.25L 42.16666666666667 8.25L 42.16666666666667 8.25L 42.16666666666667 53.083333333333336Q 38.333333333333336 56.91666666666667 34.5 53.083333333333336z"
                                                                pathFrom="M 34.5 53.083333333333336L 34.5 55L 42.16666666666667 55L 42.16666666666667 55L 42.16666666666667 55L 34.5 55"
                                                                cy="8.25" cx="42.16666666666667" j="1"
                                                                val="85" barHeight="46.75"
                                                                barWidth="7.666666666666668"></path>
                                                            <rect id="SvgjsRect1500" width="7.666666666666668"
                                                                height="55" x="72.83333333333334" y="0"
                                                                rx="5" ry="5" opacity="1"
                                                                stroke-width="0" stroke="none" stroke-dasharray="0"
                                                                fill="#f3f3f3" class="apexcharts-backgroundBar"></rect>
                                                            <path id="SvgjsPath1501"
                                                                d="M 72.83333333333334 53.083333333333336L 72.83333333333334 19.25L 80.50000000000001 19.25L 80.50000000000001 19.25L 80.50000000000001 53.083333333333336Q 76.66666666666667 56.91666666666667 72.83333333333334 53.083333333333336z"
                                                                fill="rgba(255,159,67,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="square"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="0"
                                                                clip-path="url(#gridRectMasky0zjnq0dh)"
                                                                pathTo="M 72.83333333333334 53.083333333333336L 72.83333333333334 19.25L 80.50000000000001 19.25L 80.50000000000001 19.25L 80.50000000000001 53.083333333333336Q 76.66666666666667 56.91666666666667 72.83333333333334 53.083333333333336z"
                                                                pathFrom="M 72.83333333333334 53.083333333333336L 72.83333333333334 55L 80.50000000000001 55L 80.50000000000001 55L 80.50000000000001 55L 72.83333333333334 55"
                                                                cy="19.25" cx="80.50000000000001" j="2"
                                                                val="65" barHeight="35.75"
                                                                barWidth="7.666666666666668"></path>
                                                            <rect id="SvgjsRect1502" width="7.666666666666668"
                                                                height="55" x="111.16666666666667" y="0"
                                                                rx="5" ry="5" opacity="1"
                                                                stroke-width="0" stroke="none" stroke-dasharray="0"
                                                                fill="#f3f3f3" class="apexcharts-backgroundBar"></rect>
                                                            <path id="SvgjsPath1503"
                                                                d="M 111.16666666666667 53.083333333333336L 111.16666666666667 30.25L 118.83333333333334 30.25L 118.83333333333334 30.25L 118.83333333333334 53.083333333333336Q 115 56.91666666666667 111.16666666666667 53.083333333333336z"
                                                                fill="rgba(255,159,67,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="square"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="0"
                                                                clip-path="url(#gridRectMasky0zjnq0dh)"
                                                                pathTo="M 111.16666666666667 53.083333333333336L 111.16666666666667 30.25L 118.83333333333334 30.25L 118.83333333333334 30.25L 118.83333333333334 53.083333333333336Q 115 56.91666666666667 111.16666666666667 53.083333333333336z"
                                                                pathFrom="M 111.16666666666667 53.083333333333336L 111.16666666666667 55L 118.83333333333334 55L 118.83333333333334 55L 118.83333333333334 55L 111.16666666666667 55"
                                                                cy="30.25" cx="118.83333333333333" j="3"
                                                                val="45" barHeight="24.75"
                                                                barWidth="7.666666666666668"></path>
                                                            <rect id="SvgjsRect1504" width="7.666666666666668"
                                                                height="55" x="149.5" y="0"
                                                                rx="5" ry="5" opacity="1"
                                                                stroke-width="0" stroke="none" stroke-dasharray="0"
                                                                fill="#f3f3f3" class="apexcharts-backgroundBar"></rect>
                                                            <path id="SvgjsPath1505"
                                                                d="M 149.5 53.083333333333336L 149.5 19.25L 157.16666666666666 19.25L 157.16666666666666 19.25L 157.16666666666666 53.083333333333336Q 153.33333333333334 56.91666666666667 149.5 53.083333333333336z"
                                                                fill="rgba(255,159,67,0.85)" fill-opacity="1"
                                                                stroke-opacity="1" stroke-linecap="square"
                                                                stroke-width="0" stroke-dasharray="0"
                                                                class="apexcharts-bar-area" index="0"
                                                                clip-path="url(#gridRectMasky0zjnq0dh)"
                                                                pathTo="M 149.5 53.083333333333336L 149.5 19.25L 157.16666666666666 19.25L 157.16666666666666 19.25L 157.16666666666666 53.083333333333336Q 153.33333333333334 56.91666666666667 149.5 53.083333333333336z"
                                                                pathFrom="M 149.5 53.083333333333336L 149.5 55L 157.16666666666666 55L 157.16666666666666 55L 157.16666666666666 55L 149.5 55"
                                                                cy="19.25" cx="157.16666666666666" j="4"
                                                                val="65" barHeight="35.75"
                                                                barWidth="7.666666666666668"></path>
                                                        </g>
                                                        <g id="SvgjsG1495" class="apexcharts-datalabels"
                                                            data:realIndex="0"></g>
                                                    </g>
                                                    <line id="SvgjsLine1520" x1="-10.833333333333332" y1="0"
                                                        x2="164.16666666666669" y2="0" stroke="#b6b6b6"
                                                        stroke-dasharray="0" stroke-width="1"
                                                        class="apexcharts-ycrosshairs"></line>
                                                    <line id="SvgjsLine1521" x1="-10.833333333333332" y1="0"
                                                        x2="164.16666666666669" y2="0" stroke-dasharray="0"
                                                        stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                                                    <g id="SvgjsG1522" class="apexcharts-yaxis-annotations"></g>
                                                    <g id="SvgjsG1523" class="apexcharts-xaxis-annotations"></g>
                                                    <g id="SvgjsG1524" class="apexcharts-point-annotations"></g>
                                                    <rect id="SvgjsRect1525" width="0" height="0"
                                                        x="0" y="0" rx="0" ry="0"
                                                        opacity="1" stroke-width="0" stroke="none"
                                                        stroke-dasharray="0" fill="#fefefe" class="apexcharts-zoom-rect">
                                                    </rect>
                                                    <rect id="SvgjsRect1526" width="0" height="0"
                                                        x="0" y="0" rx="0" ry="0"
                                                        opacity="1" stroke-width="0" stroke="none"
                                                        stroke-dasharray="0" fill="#fefefe"
                                                        class="apexcharts-selection-rect"></rect>
                                                </g>
                                                <g id="SvgjsG1508" class="apexcharts-yaxis" rel="0"
                                                    transform="translate(-18, 0)"></g>
                                                <g id="SvgjsG1484" class="apexcharts-annotations"></g>
                                            </svg>
                                            <div class="apexcharts-legend" style="max-height: 35px;"></div>
                                            <div class="apexcharts-tooltip apexcharts-theme-light">
                                                <div class="apexcharts-tooltip-series-group" style="order: 1;"><span
                                                        class="apexcharts-tooltip-marker"
                                                        style="background-color: rgb(255, 159, 67);"></span>
                                                    <div class="apexcharts-tooltip-text"
                                                        style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                        <div class="apexcharts-tooltip-y-group"><span
                                                                class="apexcharts-tooltip-text-label"></span><span
                                                                class="apexcharts-tooltip-text-value"></span></div>
                                                        <div class="apexcharts-tooltip-z-group"><span
                                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                                <div class="apexcharts-yaxistooltip-text"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="resize-triggers">
                                        <div class="expand-trigger">
                                            <div style="width: 218px; height: 181px;"></div>
                                        </div>
                                        <div class="contract-trigger"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Bar Chart - Orders -->

                        <!-- Line Chart - Profit -->
                        <div class="col-lg-6 col-md-3 col-6">
                            <div class="card card-tiny-line-stats">
                                <div class="card-body pb-50" style="position: relative;">
                                    <h6>Doanh thu Ofline</h6>
                                    <h2 class="font-weight-bolder mb-1">6,24k</h2>
                                    <div id="statistics-profit-chart" style="min-height: 85px;">
                                        <div id="apexcharts5aa9d04i"
                                            class="apexcharts-canvas apexcharts5aa9d04i apexcharts-theme-light"
                                            style="width: 175px; height: 70px;"><svg id="SvgjsSvg1527" width="175"
                                                height="70" xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg"
                                                xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                style="background: transparent;">
                                                <g id="SvgjsG1529" class="apexcharts-inner apexcharts-graphical"
                                                    transform="translate(12, 0)">
                                                    <defs id="SvgjsDefs1528">
                                                        <clipPath id="gridRectMask5aa9d04i">
                                                            <rect id="SvgjsRect1534" width="160" height="68"
                                                                x="-3.5" y="-1.5" rx="0"
                                                                ry="0" opacity="1" stroke-width="0"
                                                                stroke="none" stroke-dasharray="0" fill="#fff">
                                                            </rect>
                                                        </clipPath>
                                                        <clipPath id="gridRectMarkerMask5aa9d04i">
                                                            <rect id="SvgjsRect1535" width="165" height="77"
                                                                x="-6" y="-6" rx="0"
                                                                ry="0" opacity="1" stroke-width="0"
                                                                stroke="none" stroke-dasharray="0" fill="#fff">
                                                            </rect>
                                                        </clipPath>
                                                    </defs>
                                                    <line id="SvgjsLine1533" x1="60.699999999999996" y1="0"
                                                        x2="60.699999999999996" y2="65" stroke="#b6b6b6"
                                                        stroke-dasharray="3" class="apexcharts-xcrosshairs"
                                                        x="60.699999999999996" y="0" width="1"
                                                        height="65" fill="#b1b9c4" filter="none" fill-opacity="0.9"
                                                        stroke-width="1"></line>
                                                    <g id="SvgjsG1552" class="apexcharts-xaxis"
                                                        transform="translate(0, 0)">
                                                        <g id="SvgjsG1553" class="apexcharts-xaxis-texts-g"
                                                            transform="translate(0, -4)"><text id="SvgjsText1555"
                                                                font-family="Helvetica, Arial, sans-serif" x="0"
                                                                y="94" text-anchor="middle"
                                                                dominant-baseline="auto" font-size="0px"
                                                                font-weight="400" fill="#373d3f"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1556">1</tspan>
                                                                <title>1</title>
                                                            </text><text id="SvgjsText1558"
                                                                font-family="Helvetica, Arial, sans-serif"
                                                                x="30.600000000000005" y="94"
                                                                text-anchor="middle" dominant-baseline="auto"
                                                                font-size="0px" font-weight="400" fill="#373d3f"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1559">2</tspan>
                                                                <title>2</title>
                                                            </text><text id="SvgjsText1561"
                                                                font-family="Helvetica, Arial, sans-serif" x="61.2"
                                                                y="94" text-anchor="middle"
                                                                dominant-baseline="auto" font-size="0px"
                                                                font-weight="400" fill="#373d3f"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1562">3</tspan>
                                                                <title>3</title>
                                                            </text><text id="SvgjsText1564"
                                                                font-family="Helvetica, Arial, sans-serif" x="91.8"
                                                                y="94" text-anchor="middle"
                                                                dominant-baseline="auto" font-size="0px"
                                                                font-weight="400" fill="#373d3f"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1565">4</tspan>
                                                                <title>4</title>
                                                            </text><text id="SvgjsText1567"
                                                                font-family="Helvetica, Arial, sans-serif"
                                                                x="122.39999999999999" y="94"
                                                                text-anchor="middle" dominant-baseline="auto"
                                                                font-size="0px" font-weight="400" fill="#373d3f"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1568">5</tspan>
                                                                <title>5</title>
                                                            </text><text id="SvgjsText1570"
                                                                font-family="Helvetica, Arial, sans-serif"
                                                                x="152.99999999999997" y="94"
                                                                text-anchor="middle" dominant-baseline="auto"
                                                                font-size="0px" font-weight="400" fill="#373d3f"
                                                                class="apexcharts-text apexcharts-xaxis-label "
                                                                style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan1571">6</tspan>
                                                                <title>6</title>
                                                            </text></g>
                                                    </g>
                                                    <g id="SvgjsG1573" class="apexcharts-grid">
                                                        <g id="SvgjsG1574" class="apexcharts-gridlines-horizontal"></g>
                                                        <g id="SvgjsG1575" class="apexcharts-gridlines-vertical">
                                                            <line id="SvgjsLine1576" x1="0" y1="0"
                                                                x2="0" y2="65" stroke="#ebebeb"
                                                                stroke-dasharray="5" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1577" x1="30.6" y1="0"
                                                                x2="30.6" y2="65" stroke="#ebebeb"
                                                                stroke-dasharray="5" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1578" x1="61.2" y1="0"
                                                                x2="61.2" y2="65" stroke="#ebebeb"
                                                                stroke-dasharray="5" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1579" x1="91.80000000000001"
                                                                y1="0" x2="91.80000000000001" y2="65"
                                                                stroke="#ebebeb" stroke-dasharray="5"
                                                                class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1580" x1="122.4" y1="0"
                                                                x2="122.4" y2="65" stroke="#ebebeb"
                                                                stroke-dasharray="5" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine1581" x1="153" y1="0"
                                                                x2="153" y2="65" stroke="#ebebeb"
                                                                stroke-dasharray="5" class="apexcharts-gridline"></line>
                                                        </g>
                                                        <line id="SvgjsLine1583" x1="0" y1="65"
                                                            x2="153" y2="65" stroke="transparent"
                                                            stroke-dasharray="0"></line>
                                                        <line id="SvgjsLine1582" x1="0" y1="1"
                                                            x2="0" y2="65" stroke="transparent"
                                                            stroke-dasharray="0"></line>
                                                    </g>
                                                    <g id="SvgjsG1536"
                                                        class="apexcharts-line-series apexcharts-plot-series">
                                                        <g id="SvgjsG1537" class="apexcharts-series"
                                                            seriesName="seriesx1" data:longestSeries="true"
                                                            rel="1" data:realIndex="0">
                                                            <path id="SvgjsPath1551"
                                                                d="M 0 65L 30.599999999999998 39L 61.199999999999996 58.5L 91.8 26L 122.39999999999999 45.5L 153 6.5"
                                                                fill="none" fill-opacity="1"
                                                                stroke="rgba(0,207,232,0.85)" stroke-opacity="1"
                                                                stroke-linecap="butt" stroke-width="3"
                                                                stroke-dasharray="0" class="apexcharts-line"
                                                                index="0" clip-path="url(#gridRectMask5aa9d04i)"
                                                                pathTo="M 0 65L 30.599999999999998 39L 61.199999999999996 58.5L 91.8 26L 122.39999999999999 45.5L 153 6.5"
                                                                pathFrom="M -1 65L -1 65L 30.599999999999998 65L 61.199999999999996 65L 91.8 65L 122.39999999999999 65L 153 65">
                                                            </path>
                                                            <g id="SvgjsG1538" class="apexcharts-series-markers-wrap"
                                                                data:realIndex="0">
                                                                <g id="SvgjsG1540" class="apexcharts-series-markers"
                                                                    clip-path="url(#gridRectMarkerMask5aa9d04i)">
                                                                    <circle id="SvgjsCircle1541" r="2"
                                                                        cx="0" cy="65"
                                                                        class="apexcharts-marker no-pointer-events wuerw3s7u"
                                                                        stroke="#00cfe8" fill="#00cfe8" fill-opacity="1"
                                                                        stroke-width="2" stroke-opacity="1"
                                                                        rel="0" j="0" index="0"
                                                                        default-marker-size="2"></circle>
                                                                    <circle id="SvgjsCircle1542" r="2"
                                                                        cx="30.599999999999998" cy="39"
                                                                        class="apexcharts-marker no-pointer-events wv6dx7nlm"
                                                                        stroke="#00cfe8" fill="#00cfe8" fill-opacity="1"
                                                                        stroke-width="2" stroke-opacity="1"
                                                                        rel="1" j="1" index="0"
                                                                        default-marker-size="2"></circle>
                                                                </g>
                                                                <g id="SvgjsG1543" class="apexcharts-series-markers"
                                                                    clip-path="url(#gridRectMarkerMask5aa9d04i)">
                                                                    <circle id="SvgjsCircle1544" r="2"
                                                                        cx="61.199999999999996" cy="58.5"
                                                                        class="apexcharts-marker no-pointer-events wb36g0sqjf"
                                                                        stroke="#00cfe8" fill="#00cfe8" fill-opacity="1"
                                                                        stroke-width="2" stroke-opacity="1"
                                                                        rel="2" j="2" index="0"
                                                                        default-marker-size="2"></circle>
                                                                </g>
                                                                <g id="SvgjsG1545" class="apexcharts-series-markers"
                                                                    clip-path="url(#gridRectMarkerMask5aa9d04i)">
                                                                    <circle id="SvgjsCircle1546" r="2"
                                                                        cx="91.8" cy="26"
                                                                        class="apexcharts-marker no-pointer-events w7zcr380m"
                                                                        stroke="#00cfe8" fill="#00cfe8" fill-opacity="1"
                                                                        stroke-width="2" stroke-opacity="1"
                                                                        rel="3" j="3" index="0"
                                                                        default-marker-size="2"></circle>
                                                                </g>
                                                                <g id="SvgjsG1547" class="apexcharts-series-markers"
                                                                    clip-path="url(#gridRectMarkerMask5aa9d04i)">
                                                                    <circle id="SvgjsCircle1548" r="2"
                                                                        cx="122.39999999999999" cy="45.5"
                                                                        class="apexcharts-marker no-pointer-events w6kyo09y5"
                                                                        stroke="#00cfe8" fill="#00cfe8" fill-opacity="1"
                                                                        stroke-width="2" stroke-opacity="1"
                                                                        rel="4" j="4" index="0"
                                                                        default-marker-size="2"></circle>
                                                                </g>
                                                                <g id="SvgjsG1549" class="apexcharts-series-markers"
                                                                    clip-path="url(#gridRectMarkerMask5aa9d04i)">
                                                                    <circle id="SvgjsCircle1550" r="5"
                                                                        cx="153" cy="6.5"
                                                                        class="apexcharts-marker no-pointer-events wqkqaf8vp"
                                                                        stroke="#00cfe8" fill="#ffffff" fill-opacity="1"
                                                                        stroke-width="2" stroke-opacity="1"
                                                                        rel="5" j="5" index="0"
                                                                        default-marker-size="5"></circle>
                                                                </g>
                                                            </g>
                                                        </g>
                                                        <g id="SvgjsG1539" class="apexcharts-datalabels"
                                                            data:realIndex="0"></g>
                                                    </g>
                                                    <line id="SvgjsLine1584" x1="0" y1="0"
                                                        x2="153" y2="0" stroke="#b6b6b6"
                                                        stroke-dasharray="0" stroke-width="1"
                                                        class="apexcharts-ycrosshairs"></line>
                                                    <line id="SvgjsLine1585" x1="0" y1="0"
                                                        x2="153" y2="0" stroke-dasharray="0"
                                                        stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                                                    <g id="SvgjsG1586" class="apexcharts-yaxis-annotations"></g>
                                                    <g id="SvgjsG1587" class="apexcharts-xaxis-annotations"></g>
                                                    <g id="SvgjsG1588" class="apexcharts-point-annotations"></g>
                                                </g>
                                                <rect id="SvgjsRect1532" width="0" height="0" x="0"
                                                    y="0" rx="0" ry="0" opacity="1"
                                                    stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe">
                                                </rect>
                                                <g id="SvgjsG1572" class="apexcharts-yaxis" rel="0"
                                                    transform="translate(-18, 0)"></g>
                                                <g id="SvgjsG1530" class="apexcharts-annotations"></g>
                                            </svg>
                                            <div class="apexcharts-legend" style="max-height: 35px;"></div>
                                            <div class="apexcharts-tooltip apexcharts-theme-light"
                                                style="left: 58.6625px; top: 31.2px;">
                                                <div class="apexcharts-tooltip-series-group apexcharts-active"
                                                    style="order: 1; display: flex;"><span
                                                        class="apexcharts-tooltip-marker"
                                                        style="background-color: rgb(0, 207, 232);"></span>
                                                    <div class="apexcharts-tooltip-text"
                                                        style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                        <div class="apexcharts-tooltip-y-group"><span
                                                                class="apexcharts-tooltip-text-label">series-1:
                                                            </span><span class="apexcharts-tooltip-text-value">5</span>
                                                        </div>
                                                        <div class="apexcharts-tooltip-z-group"><span
                                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light"
                                                style="left: 57.2937px; top: 67px;">
                                                <div class="apexcharts-xaxistooltip-text"
                                                    style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; min-width: 8.8125px;">
                                                    3</div>
                                            </div>
                                            <div
                                                class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                                <div class="apexcharts-yaxistooltip-text"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="resize-triggers">
                                        <div class="expand-trigger">
                                            <div style="width: 218px; height: 181px;"></div>
                                        </div>
                                        <div class="contract-trigger"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Line Chart - Profit -->

                        <!-- Earnings Card -->

                        <!--/ Earnings Card -->
                    </div>
                </div>
                <!--/ Medal Card -->

                <!-- Statistics Card -->
                <div class="col-xl-8 col-md-6 col-12">
                    <div class="card card-statistics">
                        <div class="card-header">
                            <h4 class="card-title">Số lượng khách hàng</h4>
                        </div>
                        <div class="card-body statistics-body">
                            <div class="row">
                                <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                    <div class="media">
                                        <div class="avatar bg-light-info mr-2">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-user avatar-icon">
                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="media-body my-auto">
                                            <h4 class="font-weight-bolder mb-0">8.549k</h4>
                                            <p class="card-text font-small-3 mb-0">Customers</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Statistics Card -->
            </div>


        </section>
        <!-- Dashboard Ecommerce ends -->

    </div>

    <form class="row ml-lg-1" method="POST" autocomplete="off">
        @csrf
        <div class="col-md-2">
            <span>Từ Năm: </span>
            <input type="text" class="form-control" name="datepicker" id="datepicker" />
            <button type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm">Lọc kết quả</button>
        </div>
    </form>
    <div class="col-md-12">
        <div id="Chart" style="height: 250px;">
            {{-- {{ $get }} --}}
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // chart30days();
            var chart = new Morris.Bar({
                element: 'Chart',
                lineColors: ['#0b62a4', '#7A92A3', '#4da74d', '#afd8f8'],
                //data
                paseTime: false,
                pointFillColors: ['#ffffff'],
                pointStrokeColors: ['black'],
                fillOpacity: 0.6,
                hideHover: 'auto',
                paseTime: false,
                xkey: 'Thang_thu_nhap',
                // A list of names of data record attributes that contain y-values.
                ykeys: ['Tong_tien'],
                behaveLinked: true,
                // Labels for the ykeys -- will be displayed when you hover over the
                // chart.
                labels: ['Tháng Thu Nhập', 'Tổng Tiền'],
            });

            $('#btn-dashboard-filter').click(function() {
                var _token = $('input[name="_token"]').val();
                var from_date = $('#datepicker').val();
                // alert(from_date);
                // alert(to_date);
                $.ajax({
                    url: "{{ route('admin.doanh_thu.filter') }}",
                    method: "POST",
                    data: {
                        from_date: from_date,
                        _token: _token
                    },
                    success: function(data) {
                        console.log(data); // In ra dữ liệu trả về để kiểm tra
                        chart.setData(data);
                        console.log(data);
                    }
                });
            });
        });
    </script>
@endsection
