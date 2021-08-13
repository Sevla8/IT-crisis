set style line 1 linecolor rgb '#0060ad' linetype 1 linewidth 2 pointtype 7 pointsize 1.5
set terminal png size 2000,1000
set output 'dos.png'
set title "Response time of web server"
set xlabel "Date"
set xdata time
set timefmt "%s"
set format x "%m/%d/%Y %H:%M:%S"
set ylabel "Response time (s)"
plot 'dos.dat' using 1:2 with linespoints linestyle 1
