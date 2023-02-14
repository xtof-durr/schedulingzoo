<h2></h2>
<table>
<tr min-height=40 width=100% id="tr:interface"  name="interface" hide="True"> <td width=200 align=right>interface :</td>
<td>
    <input onchange="update_pb()" type="radio" name="interface" id="interface:simple" value="simple" explanation="This webpage will show only a few search options" checked="checked">
        <label id="label:interface:simple" title="This webpage will show only a few search options" for="interface:simple">$\textrm{simple}$</label>
    <input onchange="update_pb()" type="radio" name="interface" id="interface:advanced" value="advanced" explanation="This webpage will show more search options">
        <label id="label:interface:advanced" title="This webpage will show more search options" for="interface:advanced">$\textrm{advanced}$</label>
</td></tr>
</table>
<h2>Machine environment $\alpha$</h2>
<table>
<tr min-height=40 width=100% id="tr:type"  name="type"> <td width=200 align=right>type :</td>
<td>
    <input onchange="update_pb()" type="radio" name="type" id="type:1" value="1" explanation="Single machine." field="number of machines" checked="checked">
        <label id="label:type:1" title="Single machine." for="type:1">$1$</label>
    <input onchange="update_pb()" type="radio" name="type" id="type:P" value="P" explanation="Parallel identical machines. We are given $m$ machines. Processing time of job $j$ is $p_j$, independent of the machine.">
        <label id="label:type:P" title="Parallel identical machines. We are given $m$ machines. Processing time of job $j$ is $p_j$, independent of the machine." for="type:P">$P$</label>
    <input onchange="update_pb()" type="radio" name="type" id="type:Q" value="Q" explanation="Related machines. We are given $m$ machines, each with given speed $s_1,\ldots,s_m$. Processing time of job $j$ on machine $i$ is $p_j/s_j$.">
        <label id="label:type:Q" title="Related machines. We are given $m$ machines, each with given speed $s_1,\ldots,s_m$. Processing time of job $j$ on machine $i$ is $p_j/s_j$." for="type:Q">$Q$</label>
    <input onchange="update_pb()" type="radio" name="type" id="type:R" value="R" explanation="We are given $m$ unrelated machines. Processing time of job $j$ on machine $i$ is some given length $p_{ij}$.">
        <label id="label:type:R" title="We are given $m$ unrelated machines. Processing time of job $j$ on machine $i$ is some given length $p_{ij}$." for="type:R">$R$</label>
    <input onchange="update_pb()" type="radio" name="type" id="type:O" value="O" explanation="Open shop. Every job $j$ consists of $m$ operations $O_{ij}$ for $i=1,\ldots,m$.  The operations can be scheduled in any order. Operation $O_{ij}$ must be processed for $p_{ij}$ units on machine $i$.">
        <label id="label:type:O" title="Open shop. Every job $j$ consists of $m$ operations $O_{ij}$ for $i=1,\ldots,m$.  The operations can be scheduled in any order. Operation $O_{ij}$ must be processed for $p_{ij}$ units on machine $i$." for="type:O">$O$</label>
    <input onchange="update_pb()" type="radio" name="type" id="type:F" value="F" explanation="Flow shop. Every job $j$ consists of $n_j$ operations $O_{ij}$ for $k=1,\ldots,m$, to be scheduled in that order.  Operation $O_{ij}$ must be processed for $p_{ij}$ units on machine $i$.">
        <label id="label:type:F" title="Flow shop. Every job $j$ consists of $n_j$ operations $O_{ij}$ for $k=1,\ldots,m$, to be scheduled in that order.  Operation $O_{ij}$ must be processed for $p_{ij}$ units on machine $i$." for="type:F">$F$</label>
    <input onchange="update_pb()" type="radio" name="type" id="type:J" value="J" explanation="Job shop. Every job $j$ consists of $n_j$ operations $O_{kj}$ for $k=1,\ldots,n_j$, to be scheduled in that order.  Operation $O_{kj}$ must be processed for $p_{kj}$ units on a dedicated machine $\mu_{kj}$ with $\mu_{kj}\neq \mu_{k'j}$ for $k\neq k'$.">
        <label id="label:type:J" title="Job shop. Every job $j$ consists of $n_j$ operations $O_{kj}$ for $k=1,\ldots,n_j$, to be scheduled in that order.  Operation $O_{kj}$ must be processed for $p_{kj}$ units on a dedicated machine $\mu_{kj}$ with $\mu_{kj}\neq \mu_{k'j}$ for $k\neq k'$." for="type:J">$J$</label>
</td></tr>
<tr min-height=40 width=100% id="tr:number of machines"  name="number of machines" requires="not 1" separation="False"> <td width=200 align=right>number of machines :</td>
<td>
    <input onchange="update_pb()" type="radio" name="number of machines" id="number of machines:" value="" explanation="Arbitrary number of machines $m$." checked="checked">
        <label id="label:number of machines:" title="Arbitrary number of machines $m$." for="number of machines:">&Oslash;</label>
    <input onchange="update_pb()" type="radio" name="number of machines" id="number of machines:2" value="2" explanation="m=2 machines.">
        <label id="label:number of machines:2" title="m=2 machines." for="number of machines:2">$2$</label>
    <input onchange="update_pb()" type="radio" name="number of machines" id="number of machines:3" value="3" explanation="m=3 machines.">
        <label id="label:number of machines:3" title="m=3 machines." for="number of machines:3">$3$</label>
    <input onchange="update_pb()" type="radio" name="number of machines" id="number of machines:4" value="4" explanation="m=4 machines.">
        <label id="label:number of machines:4" title="m=4 machines." for="number of machines:4">$4$</label>
    <input onchange="update_pb()" type="radio" name="number of machines" id="number of machines:5" value="5" explanation="m=5 machines.">
        <label id="label:number of machines:5" title="m=5 machines." for="number of machines:5">$5$</label>
    <input onchange="update_pb()" type="radio" name="number of machines" id="number of machines:m" value="m" explanation="Fixed number of machines $m$.  Used for complexity results which are polynomial in the number of jobs, but not in the number of machines.">
        <label id="label:number of machines:m" title="Fixed number of machines $m$.  Used for complexity results which are polynomial in the number of jobs, but not in the number of machines." for="number of machines:m">$m$</label>
</td></tr>
<tr min-height=40 width=100% id="tr:robot"  name="robot" requires="advanced and F"> <td width=200 align=right>robot :</td>
<td>
    <input onchange="update_pb()" type="radio" name="robot" id="robot:" value="" explanation="No robot" checked="checked">
        <label id="label:robot:" title="No robot" for="robot:">&Oslash;</label>
    <input onchange="update_pb()" type="radio" name="robot" id="robot:R1" value="R1" requires="F" explanation="We are given a single robot that can transport the operations of a job from one machine to another. The robot can make at most one transportation per time.">
        <label id="label:robot:R1" title="We are given a single robot that can transport the operations of a job from one machine to another. The robot can make at most one transportation per time." for="robot:R1">$R1$</label>
</td></tr>
<tr min-height=40 width=100% id="tr:server"  name="server" requires="advanced and ( P or F )"> <td width=200 align=right>server :</td>
<td>
    <input onchange="update_pb()" type="radio" name="server" id="server:" value="" explanation="No server" checked="checked">
        <label id="label:server:" title="No server" for="server:">&Oslash;</label>
    <input onchange="update_pb()" type="radio" name="server" id="server:S1" value="S1" requires="P or F" explanation="Single server.">
        <label id="label:server:S1" title="Single server." for="server:S1">$S1$</label>
</td></tr>
</table>
<h2>Constraints $\beta$</h2>
<table>
<tr min-height=40 width=100% id="tr:number of jobs"  name="number of jobs" requires="advanced" add_separator="True"> <td width=200 align=right>number of jobs :</td>
<td>
    <input onchange="update_pb()" type="radio" name="number of jobs" id="number of jobs:" value="" explanation="" checked="checked">
        <label id="label:number of jobs:" title="" for="number of jobs:">&Oslash;</label>
    <input onchange="update_pb()" type="radio" name="number of jobs" id="number of jobs:n=2" value="n=2" explanation="The input consists of only 2 jobs.">
        <label id="label:number of jobs:n=2" title="The input consists of only 2 jobs." for="number of jobs:n=2">$n=2$</label>
    <input onchange="update_pb()" type="radio" name="number of jobs" id="number of jobs:n=3" value="n=3" explanation="The input consists of only 3 jobs.">
        <label id="label:number of jobs:n=3" title="The input consists of only 3 jobs." for="number of jobs:n=3">$n=3$</label>
    <input onchange="update_pb()" type="radio" name="number of jobs" id="number of jobs:n=k" value="n=k" explanation="The input consists of only k jobs.">
        <label id="label:number of jobs:n=k" title="The input consists of only k jobs." for="number of jobs:n=k">$n=k$</label>
</td></tr>
<tr min-height=40 width=100% id="tr:precedence relation"  name="precedence relation"> <td width=200 align=right>precedence relation :</td>
<td>
    <input onchange="update_pb()" type="radio" name="precedence relation" id="precedence relation:" value="" explanation="No precedence relation." checked="checked">
        <label id="label:precedence relation:" title="No precedence relation." for="precedence relation:">&Oslash;</label>
    <input onchange="update_pb()" type="radio" name="precedence relation" id="precedence relation:prec" value="prec" explanation="Given general precedence relation.  If $i\prec j$ then starting time of $j$ should be not earlier than completion time of $i$.">
        <label id="label:precedence relation:prec" title="Given general precedence relation.  If $i\prec j$ then starting time of $j$ should be not earlier than completion time of $i$." for="precedence relation:prec">$\textrm{prec}$</label>
    <input onchange="update_pb()" type="radio" name="precedence relation" id="precedence relation:chains" value="chains" requires="advanced" explanation="Given precedence relation in form of chains (indegrees and outdegrees are at most 1).">
        <label id="label:precedence relation:chains" title="Given precedence relation in form of chains (indegrees and outdegrees are at most 1)." for="precedence relation:chains">$\textrm{chains}$</label>
    <input onchange="update_pb()" type="radio" name="precedence relation" id="precedence relation:tree" value="tree" requires="advanced" explanation="Given general precedence relation in form of a tree, either intree or outtree.">
        <label id="label:precedence relation:tree" title="Given general precedence relation in form of a tree, either intree or outtree." for="precedence relation:tree">$\textrm{tree}$</label>
    <input onchange="update_pb()" type="radio" name="precedence relation" id="precedence relation:intree" value="intree" requires="advanced" explanation="Given general precedence relation in form of an intree (outdegrees are at most 1).">
        <label id="label:precedence relation:intree" title="Given general precedence relation in form of an intree (outdegrees are at most 1)." for="precedence relation:intree">$\textrm{intree}$</label>
    <input onchange="update_pb()" type="radio" name="precedence relation" id="precedence relation:outtree" value="outtree" requires="advanced" explanation="Given general precedence relation in form of an outtree (indegrees are at most 1).">
        <label id="label:precedence relation:outtree" title="Given general precedence relation in form of an outtree (indegrees are at most 1)." for="precedence relation:outtree">$\textrm{outtree}$</label>
    <input onchange="update_pb()" type="radio" name="precedence relation" id="precedence relation:opposing forest" value="opposing forest" requires="advanced" explanation="Given general precedence relation in form of a collection of intrees and outtrees.">
        <label id="label:precedence relation:opposing forest" title="Given general precedence relation in form of a collection of intrees and outtrees." for="precedence relation:opposing forest">$\textrm{opposing forest}$</label>
    <input onchange="update_pb()" type="radio" name="precedence relation" id="precedence relation:sp-graph" value="sp-graph" requires="advanced" explanation="Given precedence relation in form of a series parallel graph.">
        <label id="label:precedence relation:sp-graph" title="Given precedence relation in form of a series parallel graph." for="precedence relation:sp-graph">$\textrm{sp-graph}$</label>
    <input onchange="update_pb()" type="radio" name="precedence relation" id="precedence relation:bounded height" value="bounded height" requires="advanced" explanation="Given precedence relation where the longest directed path is bounded by a constant.">
        <label id="label:precedence relation:bounded height" title="Given precedence relation where the longest directed path is bounded by a constant." for="precedence relation:bounded height">$\textrm{bounded height}$</label>
    <input onchange="update_pb()" type="radio" name="precedence relation" id="precedence relation:level order" value="level order" requires="advanced" explanation="Given precedence relation where each vertex of a given level l (i.e. the length of the longest directed path starting from this vertex is l) is a predecessor of all the vertices of level l-1.">
        <label id="label:precedence relation:level order" title="Given precedence relation where each vertex of a given level l (i.e. the length of the longest directed path starting from this vertex is l) is a predecessor of all the vertices of level l-1." for="precedence relation:level order">$\textrm{level order}$</label>
    <input onchange="update_pb()" type="radio" name="precedence relation" id="precedence relation:interval order" value="interval order" requires="advanced" explanation="Given precedence relation for which one can associate to each vertex an interval in the real line,                     and there is a precedence between x and y if and only if the half open intervals x=[s_x,e_x) and y=[s_y,e_y) are such that e_x is smaller than or equal to s_y.">
        <label id="label:precedence relation:interval order" title="Given precedence relation for which one can associate to each vertex an interval in the real line,                     and there is a precedence between x and y if and only if the half open intervals x=[s_x,e_x) and y=[s_y,e_y) are such that e_x is smaller than or equal to s_y." for="precedence relation:interval order">$\textrm{interval order}$</label>
    <input onchange="update_pb()" type="radio" name="precedence relation" id="precedence relation:quasi-interval order" value="quasi-interval order" requires="advanced" explanation="Quasi-interval orders are a superclass of interval orders defined in Moukrim: Optimal scheduling on parallel machines for a new order class, Operations Research Letters, 24(1):91-95, 1999.">
        <label id="label:precedence relation:quasi-interval order" title="Quasi-interval orders are a superclass of interval orders defined in Moukrim: Optimal scheduling on parallel machines for a new order class, Operations Research Letters, 24(1):91-95, 1999." for="precedence relation:quasi-interval order">$\textrm{quasi-interval order}$</label>
    <input onchange="update_pb()" type="radio" name="precedence relation" id="precedence relation:over-interval order" value="over-interval order" requires="advanced" explanation="Over-interval orders are a superclass of quasi-interval orders defined in Chardon and Moukrim: The Coffman-Graham algorithm optimally solves UET task systems with overinterval orders, SIAM Journal on Discrete Mathematics, 19(1):109-121, 2005.">
        <label id="label:precedence relation:over-interval order" title="Over-interval orders are a superclass of quasi-interval orders defined in Chardon and Moukrim: The Coffman-Graham algorithm optimally solves UET task systems with overinterval orders, SIAM Journal on Discrete Mathematics, 19(1):109-121, 2005." for="precedence relation:over-interval order">$\textrm{over-interval order}$</label>
    <input onchange="update_pb()" type="radio" name="precedence relation" id="precedence relation:Am-order" value="Am-order" requires="advanced" explanation="Am orders are a superclass of over-interval orders defined in Moukrim and Quilliot: A relation between multiprocessor scheduling and linear programming. Order, 14(3):269-278, 1997.">
        <label id="label:precedence relation:Am-order" title="Am orders are a superclass of over-interval orders defined in Moukrim and Quilliot: A relation between multiprocessor scheduling and linear programming. Order, 14(3):269-278, 1997." for="precedence relation:Am-order">$\textrm{Am-order}$</label>
    <input onchange="update_pb()" type="radio" name="precedence relation" id="precedence relation:DC-graph" value="DC-graph" requires="advanced" explanation="A divide-and-conquer graph is a subclass of series-parallel graphs defined in Kubiak et al.: Optimality of HLF for scheduling divide-and-conquer UET task graphs on identical parallel processors. Discrete Optimization, 6:79-91, 2009.">
        <label id="label:precedence relation:DC-graph" title="A divide-and-conquer graph is a subclass of series-parallel graphs defined in Kubiak et al.: Optimality of HLF for scheduling divide-and-conquer UET task graphs on identical parallel processors. Discrete Optimization, 6:79-91, 2009." for="precedence relation:DC-graph">$\textrm{DC-graph}$</label>
    <input onchange="update_pb()" type="radio" name="precedence relation" id="precedence relation:2-dim partial order" value="2-dim partial order" requires="advanced" explanation="A 2-dimensional partial order is a k-dimensional partial order for k=2.">
        <label id="label:precedence relation:2-dim partial order" title="A 2-dimensional partial order is a k-dimensional partial order for k=2." for="precedence relation:2-dim partial order">$2\textrm{-dim partial order}$</label>
    <input onchange="update_pb()" type="radio" name="precedence relation" id="precedence relation:k-dim partial order" value="k-dim partial order" requires="advanced" explanation="A poset is a k-dimensional partial order iff it can be embedded into the k-dimensional Euclidian space in such a way that                     each node is represented by a k-dimensional point and there is a precedence between two nodes i and j iff for any dimension the coordinate of i is smaller than or equal to the one of j.">
        <label id="label:precedence relation:k-dim partial order" title="A poset is a k-dimensional partial order iff it can be embedded into the k-dimensional Euclidian space in such a way that                     each node is represented by a k-dimensional point and there is a precedence between two nodes i and j iff for any dimension the coordinate of i is smaller than or equal to the one of j." for="precedence relation:k-dim partial order">$\textrm{k-dim partial order}$</label>
</td></tr>
<tr min-height=40 width=100% id="tr:time lags"  name="time lags" requires="advanced and precedence relation"> <td width=200 align=right>time lags :</td>
<td>
    <input onchange="update_pb()" type="radio" name="time lags" id="time lags:" value="" explanation="no time lags" checked="checked">
        <label id="label:time lags:" title="no time lags" for="time lags:">&Oslash;</label>
    <input onchange="update_pb()" type="radio" name="time lags" id="time lags:l=1" value="l=1" explanation="unit time lags. TIMELAG">
        <label id="label:time lags:l=1" title="unit time lags. TIMELAG" for="time lags:l=1">$l=1$</label>
    <input onchange="update_pb()" type="radio" name="time lags" id="time lags:l" value="l" explanation="job independent time lags. TIMELAG">
        <label id="label:time lags:l" title="job independent time lags. TIMELAG" for="time lags:l">$l$</label>
    <input onchange="update_pb()" type="radio" name="time lags" id="time lags:l\leq0" value="l\leq0" explanation="job independent negative time lags. TIMELAG">
        <label id="label:time lags:l\leq0" title="job independent negative time lags. TIMELAG" for="time lags:l\leq0">$l\leq0$</label>
    <input onchange="update_pb()" type="radio" name="time lags" id="time lags:l>0" value="l>0" explanation="job independent positive time lags. TIMELAG">
        <label id="label:time lags:l>0" title="job independent positive time lags. TIMELAG" for="time lags:l>0">$l>0$</label>
    <input onchange="update_pb()" type="radio" name="time lags" id="time lags:l_{ij}" value="l_{ij}" explanation="arbitrary time lags. TIMELAG">
        <label id="label:time lags:l_{ij}" title="arbitrary time lags. TIMELAG" for="time lags:l_{ij}">$l_{ij}$</label>
    <input onchange="update_pb()" type="radio" name="time lags" id="time lags:l_{ij}\leq0" value="l_{ij}\leq0" explanation="arbitrary negative time lags. TIMELAG">
        <label id="label:time lags:l_{ij}\leq0" title="arbitrary negative time lags. TIMELAG" for="time lags:l_{ij}\leq0">$l_{ij}\leq0$</label>
    <input onchange="update_pb()" type="radio" name="time lags" id="time lags:l_{ij}>0" value="l_{ij}>0" explanation="arbitrary positive time lags. TIMELAG">
        <label id="label:time lags:l_{ij}>0" title="arbitrary positive time lags. TIMELAG" for="time lags:l_{ij}>0">$l_{ij}>0$</label>
</td></tr>
<tr min-height=40 width=100% id="tr:transportation delays"  name="transportation delays" requires="O or F"> <td width=200 align=right>transportation delays :</td>
<td>
    <input onchange="update_pb()" type="radio" name="transportation delays" id="transportation delays:" value="" explanation="no transportation delays" checked="checked">
        <label id="label:transportation delays:" title="no transportation delays" for="transportation delays:">&Oslash;</label>
    <input onchange="update_pb()" type="radio" name="transportation delays" id="transportation delays:t_{jk}" value="t_{jk}" requires="F" explanation="Between the completion of operation $O_{kj}$ of job $j$ on machine $k$ and the start of operation $O_{k+1,j}$ of job $j$ on machine $k+1$, there is a transportation delay of at least $t_{jk}$ units.">
        <label id="label:transportation delays:t_{jk}" title="Between the completion of operation $O_{kj}$ of job $j$ on machine $k$ and the start of operation $O_{k+1,j}$ of job $j$ on machine $k+1$, there is a transportation delay of at least $t_{jk}$ units." for="transportation delays:t_{jk}">$t_{jk}$</label>
    <input onchange="update_pb()" type="radio" name="transportation delays" id="transportation delays:t_{jkl}" value="t_{jkl}" requires="O" explanation="Between the completion of operation $O_{kj}$ of job $j$ on machine $k$ and the start of operation $O_{l,j}$ of job $j$ on machine $l$, there is a transportation delay of at least $t_{jkl}$ units.">
        <label id="label:transportation delays:t_{jkl}" title="Between the completion of operation $O_{kj}$ of job $j$ on machine $k$ and the start of operation $O_{l,j}$ of job $j$ on machine $l$, there is a transportation delay of at least $t_{jkl}$ units." for="transportation delays:t_{jkl}">$t_{\textrm{jkl}}$</label>
    <input onchange="update_pb()" type="radio" name="transportation delays" id="transportation delays:t_k" value="t_k" requires="F" explanation="Machine dependent transportation delay. Between the completion of operation $O_{kj}$ of job $j$ on machine $k$ and the start of operation $O_{k+1,j}$ of job $j$ on machine $k+1$, there is a transportation delay of at least $t_{k}$ units.">
        <label id="label:transportation delays:t_k" title="Machine dependent transportation delay. Between the completion of operation $O_{kj}$ of job $j$ on machine $k$ and the start of operation $O_{k+1,j}$ of job $j$ on machine $k+1$, there is a transportation delay of at least $t_{k}$ units." for="transportation delays:t_k">$t_k$</label>
    <input onchange="update_pb()" type="radio" name="transportation delays" id="transportation delays:t_{kl}" value="t_{kl}" requires="O" explanation="Machine pair dependent transportation delay. Between the completion of operation $O_{kj}$ of job $j$ on machine $k$ and the start of operation $O_{l,j}$ of job $j$ on machine $l$, there is a transportation delay of at least $t_{kl}$ units.">
        <label id="label:transportation delays:t_{kl}" title="Machine pair dependent transportation delay. Between the completion of operation $O_{kj}$ of job $j$ on machine $k$ and the start of operation $O_{l,j}$ of job $j$ on machine $l$, there is a transportation delay of at least $t_{kl}$ units." for="transportation delays:t_{kl}">$t_{kl}$</label>
    <input onchange="update_pb()" type="radio" name="transportation delays" id="transportation delays:t_j" value="t_j" requires="O or F" explanation="Job dependent transportation delay. Between the completion of operation $O_{kj}$ of job $j$ on machine $k$ and the start of operation $O_{l,j}$ of job $j$ on machine $l$, there is a transportation delay of at least $t_{j}$ units.">
        <label id="label:transportation delays:t_j" title="Job dependent transportation delay. Between the completion of operation $O_{kj}$ of job $j$ on machine $k$ and the start of operation $O_{l,j}$ of job $j$ on machine $l$, there is a transportation delay of at least $t_{j}$ units." for="transportation delays:t_j">$t_j$</label>
    <input onchange="update_pb()" type="radio" name="transportation delays" id="transportation delays:t_j\in\{T_1,T_2\}" value="t_j\in\{T_1,T_2\}" requires="O or F" explanation="Job dependent transportation delay out of two values. Between the completion of operation $O_{kj}$ of job $j$ on machine $k$ and the start of operation $O_{l,j}$ of job $j$ on machine $l$, there is a transportation delay of at least $t_{j}\in\{T_1,T_2\}$ units.">
        <label id="label:transportation delays:t_j\in\{T_1,T_2\}" title="Job dependent transportation delay out of two values. Between the completion of operation $O_{kj}$ of job $j$ on machine $k$ and the start of operation $O_{l,j}$ of job $j$ on machine $l$, there is a transportation delay of at least $t_{j}\in\{T_1,T_2\}$ units." for="transportation delays:t_j\in\{T_1,T_2\}">$t_j\in\{T_1,T_2\}$</label>
    <input onchange="update_pb()" type="radio" name="transportation delays" id="transportation delays:t_{jkl}=T" value="t_{jkl}=T" requires="O" explanation="Uniform transportation delay. Between the completion of operation $O_{kj}$ of job $j$ on machine $k$ and the start of operation $O_{l,j}$ of job $j$ on machine $l$, there is a transportation delay of at least $T$ units.">
        <label id="label:transportation delays:t_{jkl}=T" title="Uniform transportation delay. Between the completion of operation $O_{kj}$ of job $j$ on machine $k$ and the start of operation $O_{l,j}$ of job $j$ on machine $l$, there is a transportation delay of at least $T$ units." for="transportation delays:t_{jkl}=T">$t_{\textrm{jkl}}=T$</label>
    <input onchange="update_pb()" type="radio" name="transportation delays" id="transportation delays:t_{jk}=T" value="t_{jk}=T" requires="F" explanation="Uniform transportation delay. Between the completion of operation $O_{kj}$ of job $j$ on machine $k$ and the start of operation $O_{k+1,j}$ of job $j$ on machine $k+1$, there is a transportation delay of at least $T$ units.">
        <label id="label:transportation delays:t_{jk}=T" title="Uniform transportation delay. Between the completion of operation $O_{kj}$ of job $j$ on machine $k$ and the start of operation $O_{k+1,j}$ of job $j$ on machine $k+1$, there is a transportation delay of at least $T$ units." for="transportation delays:t_{jk}=T">$t_{jk}=T$</label>
    <input onchange="update_pb()" type="radio" name="transportation delays" id="transportation delays:t_{jkl}=t_{jlk}" value="t_{jkl}=t_{jlk}" requires="O" explanation="Job dependent Symmetric transportation delay. Between the completion of operation $O_{kj}$ of job $j$ on machine $l$ and the start of operation $O_{l,j}$ of job $j$ on machine $l$, there is a transportation delay of at least $t_{jkl}$ units, which equals $t_{jlk}$.">
        <label id="label:transportation delays:t_{jkl}=t_{jlk}" title="Job dependent Symmetric transportation delay. Between the completion of operation $O_{kj}$ of job $j$ on machine $l$ and the start of operation $O_{l,j}$ of job $j$ on machine $l$, there is a transportation delay of at least $t_{jkl}$ units, which equals $t_{jlk}$." for="transportation delays:t_{jkl}=t_{jlk}">$t_{\textrm{jkl}}=t_{\textrm{jlk}}$</label>
    <input onchange="update_pb()" type="radio" name="transportation delays" id="transportation delays:t_{kl}=t_{lk}" value="t_{kl}=t_{lk}" requires="O" explanation="Symmetric transportation delay. Between the completion of operation $O_{kj}$ of job $j$ on machine $k$ and the start of operation $O_{l,j}$ of job $j$ on machine $l$, there is a transportation delay of at least $t_{kl}$ units, which equals $t_{lk}$.">
        <label id="label:transportation delays:t_{kl}=t_{lk}" title="Symmetric transportation delay. Between the completion of operation $O_{kj}$ of job $j$ on machine $k$ and the start of operation $O_{l,j}$ of job $j$ on machine $l$, there is a transportation delay of at least $t_{kl}$ units, which equals $t_{lk}$." for="transportation delays:t_{kl}=t_{lk}">$t_{kl}=t_{lk}$</label>
</td></tr>
<tr min-height=40 width=100% id="tr:release time"  name="release time"> <td width=200 align=right>release time :</td>
<td>
    <input onchange="update_pb()" type="radio" name="release time" id="release time:" value="" explanation="no release dates" checked="checked">
        <label id="label:release time:" title="no release dates" for="release time:">&Oslash;</label>
    <input onchange="update_pb()" type="radio" name="release time" id="release time:r_j" value="r_j" explanation="Job $j$ cannot be scheduled before given release time $r_j$.">
        <label id="label:release time:r_j" title="Job $j$ cannot be scheduled before given release time $r_j$." for="release time:r_j">$r_j$</label>
    <input onchange="update_pb()" type="radio" name="release time" id="release time:online-r_j" value="online-r_j" explanation="This is an online problem. Jobs are revealed at their release times.">
        <label id="label:release time:online-r_j" title="This is an online problem. Jobs are revealed at their release times." for="release time:online-r_j">$\textrm{online-r}_j$</label>
</td></tr>
<tr min-height=40 width=100% id="tr:preemption"  name="preemption"> <td width=200 align=right>preemption :</td>
<td>
    <input onchange="update_pb()" type="radio" name="preemption" id="preemption:" value="" explanation="no preemption" checked="checked">
        <label id="label:preemption:" title="no preemption" for="preemption:">&Oslash;</label>
    <input onchange="update_pb()" type="radio" name="preemption" id="preemption:pmtn" value="pmtn" explanation="Jobs can be preempted and resumed possibly on another machine. Sometimes also denoted by 'prmp'">
        <label id="label:preemption:pmtn" title="Jobs can be preempted and resumed possibly on another machine. Sometimes also denoted by 'prmp'" for="preemption:pmtn">$\textrm{pmtn}$</label>
    <input onchange="update_pb()" type="radio" name="preemption" id="preemption:restarts" value="restarts" requires="online-r_j" explanation="Jobs can be preempted and restarted from the beginning. Sometimes called preemption with restarts as opposed to preemption with resume.">
        <label id="label:preemption:restarts" title="Jobs can be preempted and restarted from the beginning. Sometimes called preemption with restarts as opposed to preemption with resume." for="preemption:restarts">$\textrm{restarts}$</label>
</td></tr>
<tr min-height=40 width=100% id="tr:due date"  name="due date"> <td width=200 align=right>due date :</td>
<td>
    <input onchange="update_pb()" type="radio" name="due date" id="due date:" value="" explanation="no due dates" checked="checked">
        <label id="label:due date:" title="no due dates" for="due date:">&Oslash;</label>
    <input onchange="update_pb()" type="radio" name="due date" id="due date:d_j=d" value="d_j=d" explanation="Common due date $d$ to every job. Can be a deadline depending on the objective function.">
        <label id="label:due date:d_j=d" title="Common due date $d$ to every job. Can be a deadline depending on the objective function." for="due date:d_j=d">$d_j=d$</label>
    <input onchange="update_pb()" type="radio" name="due date" id="due date:d_j\leq r_j+2" value="d_j\leq r_j+2" requires="advanced and release time" explanation="The span between deadline and release time of every job is at most 2.  These are called 2-bounded instances.">
        <label id="label:due date:d_j\leq r_j+2" title="The span between deadline and release time of every job is at most 2.  These are called 2-bounded instances." for="due date:d_j\leq r_j+2">$d_j\leq r_j+2$</label>
    <input onchange="update_pb()" type="radio" name="due date" id="due date:d_j\leq r_j+3" value="d_j\leq r_j+3" requires="advanced and release time" explanation="The span between deadline and release time of every job is at most 3.  These are called 3-bounded instances.">
        <label id="label:due date:d_j\leq r_j+3" title="The span between deadline and release time of every job is at most 3.  These are called 3-bounded instances." for="due date:d_j\leq r_j+3">$d_j\leq r_j+3$</label>
    <input onchange="update_pb()" type="radio" name="due date" id="due date:d_j\leq r_j+4" value="d_j\leq r_j+4" requires="advanced and release time" explanation="The span between deadline and release time of every job is at most 4.  These are called 4-bounded instances.">
        <label id="label:due date:d_j\leq r_j+4" title="The span between deadline and release time of every job is at most 4.  These are called 4-bounded instances." for="due date:d_j\leq r_j+4">$d_j\leq r_j+4$</label>
</td></tr>
<tr min-height=40 width=100% id="tr:recirculation"  name="recirculation" requires="advanced and J"> <td width=200 align=right>recirculation :</td>
<td>
    <input onchange="update_pb()" type="radio" name="recirculation" id="recirculation:" value="" explanation="no recirculation" checked="checked">
        <label id="label:recirculation:" title="no recirculation" for="recirculation:">&Oslash;</label>
    <input onchange="update_pb()" type="radio" name="recirculation" id="recirculation:rcrc" value="rcrc" explanation="Recirculation, also called Flexible job shop. The promise on $\mu$ is lifted and for some pairs $k\neq k'$  we might have $\mu_{kj}= \mu_{k'j}$.">
        <label id="label:recirculation:rcrc" title="Recirculation, also called Flexible job shop. The promise on $\mu$ is lifted and for some pairs $k\neq k'$  we might have $\mu_{kj}= \mu_{k'j}$." for="recirculation:rcrc">$\textrm{rcrc}$</label>
</td></tr>
<tr min-height=40 width=100% id="tr:no-wait"  name="no-wait" requires="advanced and (O or F or J)"> <td width=200 align=right>no-wait :</td>
<td>
    <input onchange="update_pb()" type="radio" name="no-wait" id="no-wait:" value="" explanation="no no-wait" checked="checked">
        <label id="label:no-wait:" title="no no-wait" for="no-wait:">&Oslash;</label>
    <input onchange="update_pb()" type="radio" name="no-wait" id="no-wait:no-wait" value="no-wait" explanation="The operation $O_{k+1,i}$ must start exactly when operation $O_{k,i}$ completes.  Sometimes also denoted as 'nwt'.">
        <label id="label:no-wait:no-wait" title="The operation $O_{k+1,i}$ must start exactly when operation $O_{k,i}$ completes.  Sometimes also denoted as 'nwt'." for="no-wait:no-wait">$\textrm{no-wait}$</label>
</td></tr>
<tr min-height=40 width=100% id="tr:no-idle"  name="no-idle" requires="advanced and (O or F or J)"> <td width=200 align=right>no-idle :</td>
<td>
    <input onchange="update_pb()" type="radio" name="no-idle" id="no-idle:" value="" explanation="no no-idle" checked="checked">
        <label id="label:no-idle:" title="no no-idle" for="no-idle:">&Oslash;</label>
    <input onchange="update_pb()" type="radio" name="no-idle" id="no-idle:no-idle" value="no-idle" explanation="No machine is ever idle between two executions.">
        <label id="label:no-idle:no-idle" title="No machine is ever idle between two executions." for="no-idle:no-idle">$\textrm{no-idle}$</label>
</td></tr>
<tr min-height=40 width=100% id="tr:processing times"  name="processing times"> <td width=200 align=right>processing times :</td>
<td>
    <input onchange="update_pb()" type="radio" name="processing times" id="processing times:" value="" explanation="arbitrary processing times" checked="checked">
        <label id="label:processing times:" title="arbitrary processing times" for="processing times:">&Oslash;</label>
    <input onchange="update_pb()" type="radio" name="processing times" id="processing times:p_j=1" value="p_j=1" requires="P or Q or 1" explanation="Unit processing times.">
        <label id="label:processing times:p_j=1" title="Unit processing times." for="processing times:p_j=1">$p_j=1$</label>
    <input onchange="update_pb()" type="radio" name="processing times" id="processing times:p_j\in\{1,2\}" value="p_j\in\{1,2\}" requires="advanced and (P or Q or 1)" explanation="Every job has processing time either 1 or 2.">
        <label id="label:processing times:p_j\in\{1,2\}" title="Every job has processing time either 1 or 2." for="processing times:p_j\in\{1,2\}">$p_j\in\{1,2\}$</label>
    <input onchange="update_pb()" type="radio" name="processing times" id="processing times:p_j=p" value="p_j=p" requires="P or Q or 1" explanation="Equal processing times. All processing times are equal to some given $p$.">
        <label id="label:processing times:p_j=p" title="Equal processing times. All processing times are equal to some given $p$." for="processing times:p_j=p">$p_j=p$</label>
    <input onchange="update_pb()" type="radio" name="processing times" id="processing times:p_{ij}=p" value="p_{ij}=p" requires="R or J or O" explanation="Equal processing times. All processing times are equal to some given $p$.">
        <label id="label:processing times:p_{ij}=p" title="Equal processing times. All processing times are equal to some given $p$." for="processing times:p_{ij}=p">$p_{ij}=p$</label>
    <input onchange="update_pb()" type="radio" name="processing times" id="processing times:p_{ij}=1" value="p_{ij}=1" requires="R or J or O" explanation="Unit processing times.">
        <label id="label:processing times:p_{ij}=1" title="Unit processing times." for="processing times:p_{ij}=1">$p_{ij}=1$</label>
    <input onchange="update_pb()" type="radio" name="processing times" id="processing times:p_{ij}\in\{p_j,\infty\}" value="p_{ij}\in\{p_j,\infty\}" requires="R" explanation="Restricted machine model. Every job j comes with a set of machines on which it is allowed to be scheduled.  Sometimes also denoted as machine environment B.">
        <label id="label:processing times:p_{ij}\in\{p_j,\infty\}" title="Restricted machine model. Every job j comes with a set of machines on which it is allowed to be scheduled.  Sometimes also denoted as machine environment B." for="processing times:p_{ij}\in\{p_j,\infty\}">$p_{ij}\in\{p_j,\infty\}$</label>
    <input onchange="update_pb()" type="radio" name="processing times" id="processing times:p_{kj}=p_j" value="p_{kj}=p_j" requires="F" explanation="All operations of a same job $j$ have the same processing time.">
        <label id="label:processing times:p_{kj}=p_j" title="All operations of a same job $j$ have the same processing time." for="processing times:p_{kj}=p_j">$p_{kj}=p_j$</label>
</td></tr>
<tr min-height=40 width=100% id="tr:job size"  name="job size" requires="advanced and P"> <td width=200 align=right>job size :</td>
<td>
    <input onchange="update_pb()" type="radio" name="job size" id="job size:" value="" explanation="" checked="checked">
        <label id="label:job size:" title="" for="job size:">&Oslash;</label>
    <input onchange="update_pb()" type="radio" name="job size" id="job size:size_j" value="size_j" explanation="Multiprocessor tasks on identical parallel machines. The execution of job $j$ is done simultaneously on $size_j$ parallel machines.">
        <label id="label:job size:size_j" title="Multiprocessor tasks on identical parallel machines. The execution of job $j$ is done simultaneously on $size_j$ parallel machines." for="job size:size_j">$\textrm{size}_j$</label>
    <input onchange="update_pb()" type="radio" name="job size" id="job size:size_j\in\{1,m\}" value="size_j\in\{1,m\}" explanation="Multiprocessor tasks on identical parallel machines. Some jobs need all machines in parallel for their execution, some need only a single machine.">
        <label id="label:job size:size_j\in\{1,m\}" title="Multiprocessor tasks on identical parallel machines. Some jobs need all machines in parallel for their execution, some need only a single machine." for="job size:size_j\in\{1,m\}">$\textrm{size}_j\in\{1,m\}$</label>
</td></tr>
<tr min-height=40 width=100% id="tr:machine sets"  name="machine sets" requires="advanced and not 1"> <td width=200 align=right>machine sets :</td>
<td>
    <input onchange="update_pb()" type="radio" name="machine sets" id="machine sets:" value="" explanation="" checked="checked">
        <label id="label:machine sets:" title="" for="machine sets:">&Oslash;</label>
    <input onchange="update_pb()" type="radio" name="machine sets" id="machine sets:fix_j" value="fix_j" explanation="Multiprocessor tasks. Every job $j$ is given with a set of machines $fix_j\subseteq\{1,\ldots,m\}$, and needs simultaneously all these machines for execution. Sometimes also denoted by 'MPT'.">
        <label id="label:machine sets:fix_j" title="Multiprocessor tasks. Every job $j$ is given with a set of machines $fix_j\subseteq\{1,\ldots,m\}$, and needs simultaneously all these machines for execution. Sometimes also denoted by 'MPT'." for="machine sets:fix_j">$\textrm{fix}_j$</label>
    <input onchange="update_pb()" type="radio" name="machine sets" id="machine sets:M_j" value="M_j" explanation="Multipurpose machines. Every job $j$ needs to be scheduled on one machine out of a given set $M_j\subseteq\{1,\ldots,m\}$.  Sometimes also denoted by 'M_j'.">
        <label id="label:machine sets:M_j" title="Multipurpose machines. Every job $j$ needs to be scheduled on one machine out of a given set $M_j\subseteq\{1,\ldots,m\}$.  Sometimes also denoted by 'M_j'." for="machine sets:M_j">$M_j$</label>
</td></tr>
<tr min-height=40 width=100% id="tr:batching"  name="batching" requires="advanced and 1"> <td width=200 align=right>batching :</td>
<td>
    <input onchange="update_pb()" type="radio" name="batching" id="batching:" value="" explanation="no batching" checked="checked">
        <label id="label:batching:" title="no batching" for="batching:">&Oslash;</label>
    <input onchange="update_pb()" type="radio" name="batching" id="batching:s-batch" value="s-batch" explanation="Serial batching. The jobs have to be processed in batches. The processing time of a batch is the total processing time over all jobs in the batch.  If a new batch is started, a constant setup time $s$ occurs.">
        <label id="label:batching:s-batch" title="Serial batching. The jobs have to be processed in batches. The processing time of a batch is the total processing time over all jobs in the batch.  If a new batch is started, a constant setup time $s$ occurs." for="batching:s-batch">$\textrm{s-batch}$</label>
    <input onchange="update_pb()" type="radio" name="batching" id="batching:batch(\infty)" value="batch(\infty)" explanation="Parallel batching. The jobs have to be processed in batches. There is no limit on the number of jobs in a batch. The processing time of a batch is the maximal processing time over all jobs in the batch.  If a new batch is started, a constant setup time $s$ occurs.">
        <label id="label:batching:batch(\infty)" title="Parallel batching. The jobs have to be processed in batches. There is no limit on the number of jobs in a batch. The processing time of a batch is the maximal processing time over all jobs in the batch.  If a new batch is started, a constant setup time $s$ occurs." for="batching:batch(\infty)">$\textrm{batch}(\infty)$</label>
    <input onchange="update_pb()" type="radio" name="batching" id="batching:batch(b)" value="batch(b)" explanation="Parallel batching. The jobs have to be processed in batches. A batch consists of maximal b jobs. The processing time of a batch is the maximal processing time over all jobs in the batch.  If a new batch is started, a constant setup time $s$ occurs.">
        <label id="label:batching:batch(b)" title="Parallel batching. The jobs have to be processed in batches. A batch consists of maximal b jobs. The processing time of a batch is the maximal processing time over all jobs in the batch.  If a new batch is started, a constant setup time $s$ occurs." for="batching:batch(b)">$\textrm{batch}(b)$</label>
</td></tr>
<tr min-height=40 width=100% id="tr:setup times"  name="setup times" requires="advanced and S1"> <td width=200 align=right>setup times :</td>
<td>
    <input onchange="update_pb()" type="radio" name="setup times" id="setup times:" value="" explanation="no setup" checked="checked">
        <label id="label:setup times:" title="no setup" for="setup times:">&Oslash;</label>
    <input onchange="update_pb()" type="radio" name="setup times" id="setup times:s_j=1" value="s_j=1" requires="advanced and P and S1" explanation="unit setup times.SETUP">
        <label id="label:setup times:s_j=1" title="unit setup times.SETUP" for="setup times:s_j=1">$s_j=1$</label>
    <input onchange="update_pb()" type="radio" name="setup times" id="setup times:s_{ij}=1" value="s_{ij}=1" requires="advanced and F and S1" explanation="unit setup times.SETUP">
        <label id="label:setup times:s_{ij}=1" title="unit setup times.SETUP" for="setup times:s_{ij}=1">$s_{ij}=1$</label>
    <input onchange="update_pb()" type="radio" name="setup times" id="setup times:s_j=s" value="s_j=s" requires="advanced and P and S1" explanation="equal setup times. SETUP">
        <label id="label:setup times:s_j=s" title="equal setup times. SETUP" for="setup times:s_j=s">$s_j=s$</label>
    <input onchange="update_pb()" type="radio" name="setup times" id="setup times:s_{ij}=s" value="s_{ij}=s" requires="advanced and F and S1" explanation="equal setup times. SETUP">
        <label id="label:setup times:s_{ij}=s" title="equal setup times. SETUP" for="setup times:s_{ij}=s">$s_{ij}=s$</label>
</td></tr>
</table>
<h2>Objective function $\gamma$</h2>
<table>
<tr min-height=40 width=100% id="tr:Objective function"  name="Objective function" add_separator="True"> <td width=200 align=right>Objective function :</td>
<td>
    <input onchange="update_pb()" type="radio" name="Objective function" id="Objective function:C_{\max}" value="C_{\max}" explanation="Makespan. Minimize the maximum completion time over all jobs." checked="checked">
        <label id="label:Objective function:C_{\max}" title="Makespan. Minimize the maximum completion time over all jobs." for="Objective function:C_{\max}">$C_{\max}$</label>
    <input onchange="update_pb()" type="radio" name="Objective function" id="Objective function:C_{\min}" value="C_{\min}" requires="advanced" explanation="Santha Claus. Maximizes the minimum machine load.">
        <label id="label:Objective function:C_{\min}" title="Santha Claus. Maximizes the minimum machine load." for="Objective function:C_{\min}">$C_{\min}$</label>
    <input onchange="update_pb()" type="radio" name="Objective function" id="Objective function:\sum C_j" value="\sum C_j" explanation="Sum of completion times. $C_j$ denotes the completion time of job $j$ in some schedule. The goal is to minimize the total completion time.">
        <label id="label:Objective function:\sum C_j" title="Sum of completion times. $C_j$ denotes the completion time of job $j$ in some schedule. The goal is to minimize the total completion time." for="Objective function:\sum C_j">$\sum C_j$</label>
    <input onchange="update_pb()" type="radio" name="Objective function" id="Objective function:\sum w_jC_j" value="\sum w_jC_j" explanation="Weighted sum of completition times. Every job $j$ is given a priority weight $w_j$. $C_j$ denotes the completion time of job $j$ in some schedule.">
        <label id="label:Objective function:\sum w_jC_j" title="Weighted sum of completition times. Every job $j$ is given a priority weight $w_j$. $C_j$ denotes the completion time of job $j$ in some schedule." for="Objective function:\sum w_jC_j">$\sum w_jC_j$</label>
    <input onchange="update_pb()" type="radio" name="Objective function" id="Objective function:F_{\max}" value="F_{\max}" requires="advanced and release time" explanation="Maximum flow time. The flow time of a job is difference between its completion time and its release time, i.e. $F_j=C_j-r_j$. The goal is to minimize the maximum flow time over all jobs.">
        <label id="label:Objective function:F_{\max}" title="Maximum flow time. The flow time of a job is difference between its completion time and its release time, i.e. $F_j=C_j-r_j$. The goal is to minimize the maximum flow time over all jobs." for="Objective function:F_{\max}">$F_{\max}$</label>
    <input onchange="update_pb()" type="radio" name="Objective function" id="Objective function:\sum F_j" value="\sum F_j" requires="advanced and release time" explanation="Total flow time. The flow time of a job is difference between its completion time and its release time, i.e. $F_j=C_j-r_j$. The goal is to minimize the total flow time over all jobs.">
        <label id="label:Objective function:\sum F_j" title="Total flow time. The flow time of a job is difference between its completion time and its release time, i.e. $F_j=C_j-r_j$. The goal is to minimize the total flow time over all jobs." for="Objective function:\sum F_j">$\sum F_j$</label>
    <input onchange="update_pb()" type="radio" name="Objective function" id="Objective function:\sum w_jF_j" value="\sum w_jF_j" requires="advanced and release time" explanation="Weighted flow time. Every job $j$ is given a priority weight $w_j$.  The flow time of a job is difference between its completion time and its release time, i.e. $F_j=C_j-r_j$.">
        <label id="label:Objective function:\sum w_jF_j" title="Weighted flow time. Every job $j$ is given a priority weight $w_j$.  The flow time of a job is difference between its completion time and its release time, i.e. $F_j=C_j-r_j$." for="Objective function:\sum w_jF_j">$\sum w_jF_j$</label>
    <input onchange="update_pb()" type="radio" name="Objective function" id="Objective function:\max w_jF_j" value="\max w_jF_j" requires="advanced and release time" explanation="Maximum weighted flow time. Every job $j$ is given a priority weight $w_j$.  The flow time of a job is difference between its completion time and its release time, i.e. $F_j=C_j-r_j$.">
        <label id="label:Objective function:\max w_jF_j" title="Maximum weighted flow time. Every job $j$ is given a priority weight $w_j$.  The flow time of a job is difference between its completion time and its release time, i.e. $F_j=C_j-r_j$." for="Objective function:\max w_jF_j">$\max w_jF_j$</label>
    <input onchange="update_pb()" type="radio" name="Objective function" id="Objective function:L_{\max}" value="L_{\max}" explanation="Maximum lateness. Every job $j$ is given a due date $d_j$. The goal is to minimize $\max_j C_j-d_j$ where $C_j$ is the completion time of job $j$. By the use of binary search, this objective is essentially equivalent with testing feasibility when $d_j$ represent strict deadlines.">
        <label id="label:Objective function:L_{\max}" title="Maximum lateness. Every job $j$ is given a due date $d_j$. The goal is to minimize $\max_j C_j-d_j$ where $C_j$ is the completion time of job $j$. By the use of binary search, this objective is essentially equivalent with testing feasibility when $d_j$ represent strict deadlines." for="Objective function:L_{\max}">$L_{\max}$</label>
    <input onchange="update_pb()" type="radio" name="Objective function" id="Objective function:\sum U_j" value="\sum U_j" requires="advanced" explanation="Throughput. Every job is given a due date $d_j$.  The goal is to maximize the number of jobs that complete on time.">
        <label id="label:Objective function:\sum U_j" title="Throughput. Every job is given a due date $d_j$.  The goal is to maximize the number of jobs that complete on time." for="Objective function:\sum U_j">$\sum U_j$</label>
    <input onchange="update_pb()" type="radio" name="Objective function" id="Objective function:\sum w_jU_j" value="\sum w_jU_j" requires="advanced" explanation="Weighted throughput. Every job is given a due date $d_j$.  The goal is to maximize the total weight of jobs that complete on time.">
        <label id="label:Objective function:\sum w_jU_j" title="Weighted throughput. Every job is given a due date $d_j$.  The goal is to maximize the total weight of jobs that complete on time." for="Objective function:\sum w_jU_j">$\sum w_jU_j$</label>
    <input onchange="update_pb()" type="radio" name="Objective function" id="Objective function:\sum T_j" value="\sum T_j" requires="advanced" explanation="Maximum tardiness. Every job $j$ is given a due date $d_j$. The goal is to minimize $\sum_j \max\{0, C_j-d_j\}$ where $C_j$ is the completion time of job $j$.">
        <label id="label:Objective function:\sum T_j" title="Maximum tardiness. Every job $j$ is given a due date $d_j$. The goal is to minimize $\sum_j \max\{0, C_j-d_j\}$ where $C_j$ is the completion time of job $j$." for="Objective function:\sum T_j">$\sum T_j$</label>
    <input onchange="update_pb()" type="radio" name="Objective function" id="Objective function:\sum w_jT_j" value="\sum w_jT_j" requires="advanced" explanation="Weighted maximum tardiness. Every job $j$ is given a due date $d_j$. The goal is to minimize $\sum_j w_j \max\{0, C_j-d_j\}$ where $C_j$ is the completion time of job $j$ and $w_j$ its priority weight.">
        <label id="label:Objective function:\sum w_jT_j" title="Weighted maximum tardiness. Every job $j$ is given a due date $d_j$. The goal is to minimize $\sum_j w_j \max\{0, C_j-d_j\}$ where $C_j$ is the completion time of job $j$ and $w_j$ its priority weight." for="Objective function:\sum w_jT_j">$\sum w_jT_j$</label>
</td></tr>
</table>
