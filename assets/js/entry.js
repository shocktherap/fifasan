                <script type="text/javascript">
                  function startCalc3(){
                    interval = setInterval("calc3()",1);
                  }
                  function calc3(){
                    one = document.entry.a.value;
                    two = document.entry.b.value; 
                    document.entry.c.value = (one * 1) + (two * 1);
                  }
                  function stopCalc3(){
                    clearInterval(interval);
                  }
                </script>
                <script type="text/javascript">
                  function startCalcAtk(){
                    interval = setInterval("calcAtk()",1);
                  }
                  function calcAtk(){
                    one = document.entry.atk1.value;
                    two = document.entry.atk2.value; 
                    three = document.entry.atk3.value; 
                    document.entry.atk.value = (one * 1) + (two * 1)+ (three * 1);
                  }
                  function stopCalcAtk(){
                    clearInterval(interval);
                  }
                </script>
                <script type="text/javascript">
                  function startCalcBhp(){
                    interval = setInterval("calcBhp()",1);
                  }
                  function calcBhp(){
                    one = document.entry.bhp1.value;
                    two = document.entry.bhp2.value; 
                    document.entry.bhp.value = (one * 1) + (two * 1);
                  }
                  function stopCalcBhp(){
                    clearInterval(interval);
                  }
                </script>
                <script type="text/javascript">
                  function startCalcLdj(){
                    interval = setInterval("calcLdj()",1);
                  }
                  function calcLdj(){
                    one = document.entry.ldj1.value;
                    two = document.entry.ldj2.value; 
                    document.entry.ldj.value = (one * 1) + (two * 1);
                  }
                  function stopCalcLdj(){
                    clearInterval(interval);
                  }
                </script>
                <script type="text/javascript">
                  function startCalcKbm(){
                    interval = setInterval("calcKbm()",1);
                  }
                  function calcKbm(){
                    one = document.entry.kbm1.value;
                    two = document.entry.kbm2.value; 
                    three = document.entry.kbm3.value;
                    four = document.entry.kbm4.value;
                    five = document.entry.kbm5.value;
                    six = document.entry.kbm6.value;
                    seven = document.entry.kbm7.value;
                    eight = document.entry.kbm8.value;
                    document.entry.kbm.value = (one * 1) + (two * 1) + (three * 1) + (four * 1) + (five * 1) + (six * 1) + (seven * 1) + (eight * 1);
                  }
                  function stopCalcKbm(){
                    clearInterval(interval);
                  }
                </script>
                <script type="text/javascript">
                  function startCalcKs(){
                    interval = setInterval("calcKs()",1);
                  }
                  function calcKs(){
                    one = document.entry.ks1.value;
                    two = document.entry.ks2.value; 
                    three = document.entry.ks3.value;
                    four = document.entry.ks4.value;
                    five = document.entry.ks5.value;
                    document.entry.ks.value = (one * 1) + (two * 1) + (three * 1) + (four * 1) + (five * 1);
                  }
                  function stopCalcKs(){
                    clearInterval(interval);
                  }
                </script>
                <script type="text/javascript">
                  function startCalcPp(){
                    interval = setInterval("calcPp()",1);
                  }
                  function calcPp(){
                    one = document.entry.pp1.value;
                    two = document.entry.pp2.value; 
                    document.entry.pp.value = (one * 1) + (two * 1);
                  }
                  function stopCalcPp(){
                    clearInterval(interval);
                  }
                </script>
                <script type="text/javascript">
                  function startCalcSbsd(){
                    interval = setInterval("calcSbsd()",1);
                  }
                  function calcSbsd(){
                    one = document.entry.sbsd1.value;
                    document.entry.sbsd.value = (one * 1);
                  }
                  function stopCalcSbsd(){
                    clearInterval(interval);
                  }
                </script>
                <script type="text/javascript">
                  function startCalcBB(){
                    interval = setInterval("calcBB()",1);
                  }
                  function calcBB(){
                    one = document.entry.sbsd.value;
                    two = document.entry.pp.value;
                    three = document.entry.ks.value;
                    four = document.entry.ldj.value;
                    five = document.entry.bhp.value;
                    six = document.entry.atk.value;
                    seven = document.entry.kbm.value;
                    document.entry.BB.value = (one * 1)+(two * 1)+(three * 1)+(four * 1)+(five * 1)+(six * 1)+(seven * 1 );
                  }
                  function stopCalcBB(){
                    clearInterval(interval);
                  }
                </script>
                <script type="text/javascript">
                  function startCalcTL(){
                    interval = setInterval("calcTL()",1);
                  }
                  function calcTL(){
                    one = document.entry.bp.value;
                    two = document.entry.BB.value;
                    three = document.entry.c.value;
                    four = document.entry.bll1.value;
                    document.entry.total.value = (one * 1)+(two * 1)+(three * 1)+(four * 1);
                  }
                  function stopCalcTL(){
                    clearInterval(interval);
                  }
                </script>