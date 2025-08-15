@extends('web.layout.master')
@section('content')
<section class="breadcrumb-main">
    <div class="container">
        <div class="row">
            <div id="breadcrumb">
                <div class="breadcrumb-txt">
                    <h3>Resource Detail</h3>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="breadcrumb-nav">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('resource') }}">Resources</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Courtship in the Philippines</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="resource-detail bg-lightgrey ptb-80 heading_hidden">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-5 about-us courtship_philippines_img">
                <div class="about-img-block ">
                    <img src="{{ asset('assets/img/bigstock_Smiling_Couple.jpg') }}">
                </div>
            </div>
            <div class="col-md-6 mb-3 align-self-center">
                <div class="heading mb-3">
                    <h2>Courtship in The Philippines</h2>
                </div>
                <p class="lh-175">The Philippines is a heavily traditional and romantic country and if you are looking to date a Filipino lady, knowing the way things are done in her homeland will go a long way to putting you in a good light. Courtship in the Philippines is a courtlier and gentlemanly affair, and many American men find they enjoy the experience in comparison to the less traditional ways of dating back home in the USA.</p>
            </div>
            <div class="col-md-12 mb-3">
                <div class="heading mb-3">
                    <h2>Discretion is The Key</h2>
                </div>
                <p class="lh-175">Traditionally, a male suitor will approach a Filipino lady whom he wishes to court in a discreet and friendly manner, so as not to appear aggressive or arrogant.  Simply approaching a woman in a bar, or on the street and asking her phone number, as may be done in the West, is considered completely unacceptable and even offensive and although many ladies understand that the American might not understand this and forgive him, this is not a good start to a relationship.</p>
            </div>
            <div class="col-md-12 mb-3">
                <div class="heading mb-3">
                    <h2>Teasing And “Pairing Off”</h2>
                </div>
                <p class="lh-175">Some ladies do conduct their courtship in the form of simple dates (with chaperones) similar to the manner used in previous decades in the West. However the traditional and more appreciated method of gaining the interest of a Filipino woman is through a practice known as “teasing” and “pairing off” (tuksuhan lang in Tagalog).</p>
                <p class="lh-175">The “teasing” is conducted by friends and peers of a couple being matched and allows both sides to discover their compatibility without losing face through rejection, or seeming to be over eager and forward. The “teasing” stage is particularly valued by shy or inexperienced men as it allows them to progress carefully and gently without worrying that any mistakes will be exposed to the community at large.</p>
                <p class="lh-175">During this testing and evaluation period either a Filipino lady will deny any feelings for the suitor and avoid him, giving him a clear message that he has been unsuccessful and allowing the man to back off without losing face, or she will encourage the courtship and the more formal stage of courting will begin. However, remember that a traditional Filipino lady is expected to be shy and secretive about her real feelings regarding a potential partner and it is important to be sure and take advice of her peers before breaking off the “teasing” stage too soon.</p>
            </div>
            <div class="col-md-12 mb-3">
                <div class="heading mb-3">
                    <h2>Building a Bridge</h2>
                </div>
                <p class="lh-175">Some shy or inexperienced suitors (known as torpe in the Philippines) may employ the use of a “human bridge” or tulay to help the process along. This would be a close friend of both the man and the woman who would act as a go between and communication channel for the couple.  The “human bridge” is also sometimes used to ask formal permission from the lady’s family for the courtship to begin.</p>
            </div>
            <div class="col-md-12 mb-3">
                <div class="heading mb-3">
                    <h2>Formal Courtship</h2>
                </div>
                <p class="lh-175">After a successful teasing stage the couple move forward into a more formal and recognized courtship.  The expected first step in this process is for the man to approach the lady’s family and formally request to engage their daughter in courtship. It is considered unacceptable to proceed into dating a girl without showing your face to her family, although in some cases the initial introductions can be performed through the tulay or “human bridge”.  At this meeting  (and any other time the man goes to the home) it is also important to bring gifts (pasalubong) for the family in order to be considered acceptable.</p>
                <p class="lh-175">Once the agreement of the family has been gained formal courtship can begin. This a rather more gentle and discreet process than in the USA; rather than in western culture where it's not unusual to share a house mortgage within a very short time, women are rarely allowed to spend time alone with a potential suitor and courtship will proceed around quiet dates and visits to the family. After a number of dates, if all goes well the couple will be considered magkasintahan (formally girlfriend and boyfriend).</p>
                <p class="lh-175">In the past, especially in rural areas a man would be expected to make a harana (serenade) at night and sing her songs of love and romance, however this is rarely performed these days.</p>
            </div>
            <div class="col-md-12 mb-3">
                <div class="heading mb-3">
                    <h2>Playing Hard To Get</h2>
                </div>
                <p class="lh-175">Filipino women are traditionally expected to be pakipot (play hard to get) during the courtship ritual. This supports the idea that a Filipino girl should be mahinhin (modest, shy, and well-mannered with good upbringing) and does not show her admirer that she is interested immediately. This behavior is nothing to be concerned about and is seen as a test to ensure the sincerity of the man and his affection for the lady concerned. Do not expect instant results during courtship, indeed it is not unusual, unlike in the West, for dating to continue for years before a lady is prepared to accept a marriage proposal.</p>
            </div>
            <div class="col-md-12 mb-3">
                <div class="heading mb-3">
                    <h2>Wedding Bells</h2>
                </div>
                <p class="lh-175">After varying periods of being mahinhin the couple may decide they wish to get married. The traditional method of asking for a lady’s hand in marriage is called pamamanhikan and is not unlike how we do things in the USA. This involves visiting the Filipino woman’s home and formally asking consent to marry her from her parents and/or family. This is also the period of time when traditionally, parents from both sides would start getting to know about each other. As with any visit to the family house, gifts should be presented in order to put you in good stead with the family.</p>
            </div>
            <div class="col-md-12 mb-3">
                <div class="heading mb-3">
                    <h2>A Romantic And Affectionate Experience</h2>
                </div>
                <p class="lh-175">American men have described the process of courtship in the Philippines as a romantic and affectionate experience, not unlike how they imagine knights in armor to approach their love or how things used to be performed in the West.  The slower pace and more thoughtful approach is often seen as being more intimate than the rushed, all out in the open, contrast of how dating is sometimes performed in the USA today.  This gentle courtship frequently blossoms into relationships that are much more robust and long-lasting than their Western counterparts and by respecting the culture of your Filipino lady you will find yourself a dedicated, loving and affectionate wife, who was definitely worth every second you spent in courtship.</p>
            </div>
        </div>
    </div>
</section>
@endsection