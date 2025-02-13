@extends('client.app', ['title' => 'billing'])
@section('content')
<div class="main-content">
    <form class="billing-sections-wrapper">
        <div class="billings-wrapper">
            <div class="billings-wrapper-header">
                <h2>Billing Details</h2>
            </div>

            <div class="billing-details-input-wrapper">
                <div class="input-wrapper-large">
                    <label>Full Name<span>*</span></label>
                    <input type="text" placeholder="Adam Smith" />
                </div>
                <div class="input-wrapper-large">
                    <label>Street Address<span>*</span></label>
                    <input type="text" placeholder="3/4 street House no.4" />
                </div>
                <div class="input-wrapper-large">
                    <label>State/Province<span>*</span></label>
                    <select>
                        <option value="Riyadh">Riyadh</option>
                        <option value="Mecca">Makkah (Mecca)</option>
                        <option value="Madinah">Medina (Madinah)</option>
                        <option value="Asir">Asir</option>
                        <option value="Tabuk">Tabuk</option>
                        <option value="Hail">Hail</option>
                        <option value="Jizan">Jizan</option>
                        <option value="Najran">Najran</option>
                        <option value="Al-Bahah">Al-Bahah</option>
                        <option value="Al-Jouf">Al-Jouf (Al Jawf)</option>
                        <option value="Qassim">Qassim (Al-Qassim)</option>
                    </select>
                </div>
                <div class="input-wrapper-large">
                    <label>City<span>*</span></label>
                    <select>
                        <option value="riyadh">Riyadh</option>
                        <option value="mecca">Mecca (Makkah)</option>
                        <option value="jeddah">Jeddah</option>
                        <option value="taif">Taif</option>
                        <option value="medina">Medina (Madinah)</option>
                        <option value="yanbu">Yanbu</option>
                        <option value="dammam">Dammam</option>
                        <option value="khobar">Khobar</option>
                        <option value="al-ahsa">Al Ahsa</option>
                        <option value="dhahran">Dhahran</option>
                        <option value="abha">Abha</option>
                        <option value="khamis-mushait">Khamis Mushait</option>
                        <option value="najran">Najran</option>
                        <option value="tabuk">Tabuk</option>
                        <option value="umluj">Umluj</option>
                        <option value="hail">Hail</option>
                        <option value="arar">Arar</option>
                        <option value="rafha">Rafha</option>
                        <option value="jizan">Jizan</option>
                        <option value="sabya">Sabya</option>
                        <option value="sharurah">Sharurah</option>
                        <option value="al-bahah">Al-Bahah</option>
                        <option value="baljurashi">Baljurashi</option>
                        <option value="sakakah">Sakakah</option>
                        <option value="al-qurayyat">Al Qurayyat</option>
                        <option value="buraidah">Buraidah</option>
                        <option value="unaizah">Unaizah</option>
                    </select>
                </div>
                <div class="input-wrapper-large">
                    <label>Postal Code<span>*</span></label>
                    <input type="number" placeholder="232874" />
                </div>
                <div class="input-wrapper-large">
                    <label>Phone Number<span>*</span></label>
                    <input type="tel" placeholder="+898-2786223" />
                </div>
                <div class="input-wrapper-large">
                    <label>Email<span>*</span></label>
                    <input type="email" placeholder="adam_smith@Email.com" />
                </div>
            </div>
        </div>

        <div class="billings-wrapper">
            <div class="billings-wrapper-header">
                <div>
                    <h2>Payment</h2>
                    <p>All transections are secure and encrypted</p>
                </div>

                <div class="card-images">
                    <img src="{{ asset('frontend') }}/images/mastercard.png" alt="card-image" />
                    <img src="{{ asset('frontend') }}/images/visacard.png" alt="card-image" />
                </div>
            </div>

            <div class="billing-details-input-wrapper">
                <div class="input-wrapper-large">
                    <label>Card Number</label>
                    <input type="text" placeholder="**** ***** **** 09232" />
                </div>
                <div class="input-wrapper-large">
                    <label>Expiration Date(MM/YY)</label>
                    <input type="text" placeholder="12/24" />
                </div>
                <div class="input-wrapper-large">
                    <label>Security Code</label>
                    <input type="password" placeholder="***********" />
                </div>
                <div class="input-wrapper-large">
                    <label>Name On Card</label>
                    <input type="password" placeholder="Adam Smith" />
                </div>

                <!-- make this button submit -->
                <button
                    type="button"
                    class="btn-common"
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Pay Now
                </button>
            </div>
        </div>
    </form>
</div>
@endsection