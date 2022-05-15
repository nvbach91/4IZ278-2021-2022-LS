import logo from './logo.svg';
import './App.css';
import { useEffect, useState } from 'react';
import {AppContextProvider} from './context'
import {BrowserRouter,Routes,Route,} from "react-router-dom";
import axios from 'axios';
//import dotenv from 'dotenv'

// Styles
import './styles/Default.scss';

//Componenents
import Helmet from 'helmet'
import Header from './components/Header';
import Footer from './components/Footer';
import {NabidkaRestaurace_view} from './views/NabidkaRestaurace_view'
import {DetailRestaurace_view} from './views/DetailRestaurace_view'
import 'bootstrap/dist/css/bootstrap.min.css';
import { DokoncitObjednavku_view } from './views/DokoncitObjednavku_view';
import { Login_view } from './views/Login_view';
import { Registrovat_view } from './views/Registrovat_view';
import { MujUcetObjednavky_view } from './views/MujUcetObjednavky_view';
import { MujUcet_view } from './views/MujUcet_view';

function App() {
  const [data, setData] = useState();

  useEffect(() => {
    const fetchData = async () => {
      const data = await axios.post(`http://localhost/php_react/backend/api/post/read.php`);
      setData(data.data)
    }
    fetchData();
  }, [])
  

  return (
    <AppContextProvider >
          {/* <Helmet>
            <title>Vše Food Delivery</title>
          </Helmet> */}
          {/* {
            (this.props.location.pathname!=='/login' && this.props.location.pathname!=='/register') ? <Header userLoggedIn = {false}/>:''
          } */}

          <Header userLoggedIn = {false}/>
          <div className="contentWrap">
            <BrowserRouter>
              <Routes>
                <Route path="/" element={<NabidkaRestaurace_view/>}/>
                <Route path="/nabidka-restauraci" element={<NabidkaRestaurace_view/>}/>
                <Route path="/nabidka-restauraci/:restaurace" element={<DetailRestaurace_view />} />
                <Route path="/dokoncit-objednavku" element={<DokoncitObjednavku_view />} />
                <Route path="/login" element={<Login_view />} />
                <Route path="/registrovat" element={<Registrovat_view />} />
                <Route path="/muj-ucet" element={<MujUcet_view />} />
                <Route path="/muj-ucet/objednavky" element={<MujUcetObjednavky_view />} />
                

                    

                  {/*<Route index element={<Home />} />
                   <Route path="teams" element={<Teams />}>
                    <Route path=":teamId" element={<Team />} />
                    <Route path="new" element={<NewTeamForm />} />
                    <Route index element={<LeagueStandings />} />
                  </Route> */}
                
              </Routes>
            </BrowserRouter>
            <Footer/>
          {/* <Routes>

          <Route path="/" element={<NabidkaRestaurace_view/>} />
            <Route path="/nabidka-restaurace" element={<NabidkaRestaurace_view/>} />
            
            {/* <Route path="/" exact component={() => <Index didSearch = {false} onMobileApp = {onMobileApp} userLoggedIn = {userLoggedIn} />} />
            <ProtectedRoute path="/mujucet" component={MyAccount} />
            <Route path="/404" exact component={NotFound} />
            

            <Route path="/hotovo" exact component={Thanks} />
            <Route path="/hotovo/:year/:cislo" exact component={Thanks} />
            <Route path="/obnova-hesla" exact component={ResetPassword} />
            <Route path="/aktivace-uctu" exact component={ActivateAccount} />
            <Route path="/detail" component={Detail} />
            <Route path="/rozvoz-jidel/:id/:restaurant" component={Detail} />
            <Route path="/rozvoz-jidel/:id" children={<Index didSearch = {true} onMobileApp = {onMobileApp} userLoggedIn = {userLoggedIn} />} />
            <Route path="/objednavka/:year/:cislo" component={TrackOrder} />
            <Route path="/kontakt-rozvoz-jidel/:id" component={Contact} />
            <Route path="/kontakt-rozvoz-jidel" component={KontaktRozvozJidel} />
            <Route path="/podminky-uziti-stranek" component={Podminikyuzitistranek} />
            <Route path="/seznam-alergenu" component={SeznamAlergenu} />
            <Route path="/vseobecne-obchodni-podminky/:id" component={VOP} />
            <Route path="/poledni-menu/:city" component={PoledniMenu} />
            <Route path="/kontakt-spoluprace" component={KontaktSpoluprace} />
            <Route path="/stan-se-kuryrem" component={StanSeKuryrem} />
            <Route path="/cerpani-kreditu" component={JakNaKredity} />
            <Route path="/soukromi" component={Soukromi} />
            
            <Route exact component={NotFound} />
          </Routes>  */}
          </div>
          {/* {
            (this.props.location.pathname!=='/login' && this.props.location.pathname!=='/register') ? <Footer/>:''
          } */}
      </AppContextProvider >
  );
}

export default App;
